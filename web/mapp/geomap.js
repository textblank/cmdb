/**
 * 矢量地图渲染，使用jquery, 支持topojson格式, 支持svg的使用svg，不支持的使用vml
 * @author iceshi
 * @date 20150612
 */

 (function($){

    var Canvas = {
        type: document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1") ? 'svg' :'vml',
        create: function(container){
            this.engine = this[this.type];
            this.engine.init(container);
            return this.engine;
        },
        svg: {
            namespace: "http://www.w3.org/2000/svg",
            init: function(container){
                this.container = container;
                this.root = this.element("svg").attr({width: "100%",height: "100%"}).attr('class', 'canvas').appendTo(this.container);
                this.root.append(this.element("defs").attr({id: "svgDefs"}));
            },
            element: function(el){
                return $(document.createElementNS(this.namespace, el));
            },
            path: function(arcs, group){
                var path = [];
                for(var i = 0; i < arcs.length; i++){
                    path[i] = 'M' + arcs[i].shift() + 'L' + arcs[i].join();
                }
                return this.element('path').attr({d: path.join(' '), 'stroke-width' : 1}).appendTo(group || this.root);
            },
            transform: function(el, tr){
                el.attr('transform', 'matrix(' + tr.scale + ',0,0,' + tr.scale + ',' + tr.translate[0] + ',' + tr.translate[1] + ')');
                return el.attr('stroke-width', 1 / tr.scale);
            },
            group: function(){
                return this.element('g').appendTo(this.root);
            },
            attr: function(el, attr){
                return el.css.call(el, attr);
            }
        },
        vml: {
            attrMap : {
                fill: 'fillcolor',
                stroke: 'strokecolor',
            },
            init: function(container){
                this.container = container;
                document.namespaces.add("v", "urn:schemas-microsoft-com:vml");
                document.createStyleSheet().addRule(".v", "behavior:url(#default#VML)");
                this.root = $('<div/>').addClass('canvas').css({position:'absolute', left:0, top:0}).appendTo(this.container);
            },
            element: function(el){
                var el = $(document.createElement('<v:' + el + ' class="v"/>'));
                var coord = factor + ',' + factor;
                return el.attr({coordsize: coord}).css({position: "absolute",top: 0,left: 0});
            },
            path: function(arcs, group){
                var path = [];
                for(var i = 0; i < arcs.length; i++){
                    //vml的坐标不支持小数，做取整处理
                    var points = [];
                    for(var j = 0; j < arcs[i].length; j++){
                        points[j] = [Math.round(arcs[i][j][0]), Math.round(arcs[i][j][1])];
                    }
                    path[i] = 'M' + points.shift() + 'L' + points.join();
                }
                return this.element('shape').attr({path: path.join(' ')}).appendTo(group || this.root);
            },
            transform: function(el, tr){
                var w = h = Math.round(factor * tr.scale);
                var l = Math.round(tr.translate[0]);
                var t = Math.round(tr.translate[1]);
                return el.css({width: w,height: h,left: l,top: t});
            },
            group: function(){
                return this.element('group').appendTo(this.root);
            },
            attr: function(el, attr){
                var newAttr = {};
                $.each(this.attrMap, function(k, v){
                    el.each(function(){
                        this[v] = attr[k];
                    });
                });
                el.css.call(el, attr);
            }
        }
    }

    //坐标投影因子，因子越大，得到的坐标值越大
    var factor = 10000;

    //米勒投影，用于经纬度到平面坐标的映射
    function millerXY (point){
        var L =  1 * Math.PI * 2,     // 地球周长
        W = L, // 平面展开后，x轴等于周长
        H = L / 2, // y轴约等于周长一半
        mill = 1.27, // 米勒投影中的一个常数，范围大约在正负2.3之间
        x = point[0] * Math.PI / 180, // 将经度从度数转换为弧度
        y = point[1] * Math.PI / 180; // 将纬度从度数转换为弧度
        // 这里是米勒投影的转换
        y = 1.25 * Math.log( Math.tan( 0.25 * Math.PI + 0.4 * y ) );
        // 这里将弧度转为实际距离
        x = ( W / 2 ) + ( W / (2 * Math.PI) ) * x;
        y = ( H / 2 ) - ( H / ( 2 * mill ) ) * y;
        // 转换结果的单位是公里
        // 可以根据此结果，算出在某个尺寸的画布上，各个点的坐标
        return [x * factor, y * factor];
    }

    //计算多边形的中心
    function centriod(points){
        var i = 0, p1, p2, cx = 0, cy = 0, area = 0, len = points.length, tmp;
        p2 = points[len-1];
        for(i=0; i<len; i++){
            p1 = p2;
            p2 = points[i];
            tmp = p1[0] * p2[1] - p1[1] * p2[0];
            cx += (p1[0] + p2[0]) * tmp;
            cy += (p1[1] + p2[1]) * tmp;
            area += tmp;
        }
        var multi = 6 * area * 0.5;
        return [cx / multi, cy / multi];
    }

    /**
     * topojson的解析，目前支持polygon和multipolygon
     * topojson的格式规范见https://github.com/mbostock/topojson-specification/blob/master/README.md
     */
    var topoJsonParser = {
        //解析后的绝对坐标
        arcs: null,
        /**
         * 将arc转换为绝对坐标
         * @param transform topology格式的transform
         * @param arcs 由多个arc组成的数组，每个arc为多个point组成
         */

        decodeArc: function(arcs, transform, offset){
            offset = offset || [0, 0];
            var len = arcs.length, arcMap = [];
            for(var i = 0; i < len; i++){
                var line = [], x = y = 0;
                for(var j = 0; j < arcs[i].length; j++){
                    var p = [
                        (x += arcs[i][j][0]) * transform.scale[0] + transform.translate[0],
                        (y += arcs[i][j][1]) * transform.scale[1] + transform.translate[1]
                    ];
                    point = millerXY(p);
                    line.push([point[0] - offset[0], point[1] - offset[1]]);
                }
                arcMap.push(line);
            }
            return arcMap;
        },
        /**
         * 将每个图形的arc索引转换成真实的坐标点
         */
        decodeArcIndex: function(arcIndex){
            var arc = [];
            for(var i = 0; i < arcIndex.length; i++){
                var index = arcIndex[i];
                //数组复制，防止原始数据被修改
                var realArc = index >= 0 ? this.arcMap[index].slice(0) : this.arcMap[~index].slice(0).reverse();
                //每个arc的第一个position都与前一个arc的最后一个position相同, 要去掉每个arc的第一个poisiton
                arc = arc.concat(i ? realArc.slice(1) : realArc);
            }
            return arc;
        },

        /**
         * 每个polygon由多个arc组成，如果polygon有hole(里面有孔),第一个arc是最外层的路径
         */
        Polygon: function(arcsIndex){
            var arcs = [];
            for(var i = 0; i < arcsIndex.length; i++){
                arcs[i] = this.decodeArcIndex(arcsIndex[i]);
            }
            return arcs;
        },

        /**
         * 多个多边形，按照有孔的polygon处理，减少数组的一个维度
         */
        MultiPolygon: function(arcsIndex){
            var arcs = [];
            for(var i = 0; i < arcsIndex.length; i++){
                arcs = arcs.concat(this.Polygon(arcsIndex[i]));
            }
            return arcs;
        },
        /**
         * 解析一个图形，返回arc数组 [[[1,1], [2,2]...], [[3,3],[4,4]...]]
         */
        parseShape: function(object, key){
            var type = object.type;
            var arcs = this[type](object.arcs);
            var points = [];
            for(var i=0; i < arcs.length; i++){
                points = points.concat(arcs[i]); 
            }
            return {
                arcs: arcs,
                properties: object.properties,
                id: key,
                center: centriod(points)
            };
        },

        parse: function(json){
            this.arcMap = this.decodeArc(json.arcs, json.transform);
            var shapes = [];
            for(i in json.objects){
                shapes.push(this.parseShape(json.objects[i], i));
            }
            return shapes;
        }
    };

    //图层
    function Layer(json, map, regionId, options){
        this.map = map;
        this.id = regionId;
        this.titles = [];
        options = options || {};
        this.style = $.extend({}, this.style, options.style);
        this.titleStyle = $.extend({}, this.titleStyle, options.titleStyle);
        //保存区域的映射表
        this.regions = {};
        this.currentTransform = null;
        var bbox = [].concat(millerXY(json.bbox.slice(0, 2)), millerXY(json.bbox.slice(2)));
        this.oriRect = {
            left: bbox[0],
            top: bbox[3],
            width : bbox[2] - bbox[0],
            height : bbox[1] - bbox[3]
        };
        var canvas = map.canvas;
        var shapes = topoJsonParser.parse(json);
        var self = this;
        $.each(shapes, function(index, shape){
            var path = canvas.path(shape.arcs);
            path.data({id: shape.id, parent: self.id, prop: shape.properties, center: shape.center, region: path});
            path.css('transition', 'fill .3s, stroke .3s');
            canvas.attr(path, self.style);
            self.regions[shape.id] = path;
        });
        self.path = shapes[0].arcs.join();
        this.addTitle();

        this.focus();
    }

    Layer.prototype = {
        //基本样式
        style: {
            fill: '#fff',
            stroke: '#e7e7e7',
            cursor: 'pointer'
        },
        //标题样式
        titleStyle : {
            color:'#999',
            position: 'absolute',
            cursor: 'pointer',
            'font-size':'12px',
            'white-space': 'nowrap',
            padding: '2px 8px'
        },
       
        /**
         * 图层的变形
         * @param transform object
         *   transform.scale 放大或缩小的倍数
         *   transform.translate array [0]translateX [1]translateY
         */
        transform: function(transform){
            var self = this;
            this.currentTransform = transform;
            $.each(this.regions, function(){
                self.map.canvas.transform(this, transform);
            });

            var tx = transform.translate[0];
            var ty = transform.translate[1];
            $.each(this.titles, function(){
                var $me = $(this);
                var rect = $me.data("rect");
                $me.css({
                    left: rect.x * transform.scale + tx - rect.width / 2,
                    top: rect.y * transform.scale + ty - rect.height / 2
                });
            });
        },

        //应用动画变换 
        animate: function(targetTransform, option){
            option = $.extend({duration: 600}, option);
            function step(ratio){
                this.transform(this.stepTransform(targetTransform, ratio));
                option.step && option.step.call(this, ratio);
            }
            $({rate: 0}).animate({rate: 1}, {
                start: $.proxy(option.start || $.noop, this),
                duration: option.duration,
                step: $.proxy(step, this),
                complete: $.proxy(option.end || $.noop, this)
            });
        },

        //获取每一步要变化的transform数据
        stepTransform: function(targetTransform, ratio){
            var base = this.currentTransform;
            var diffScale = targetTransform.scale - base.scale;
            var diffX = targetTransform.translate[0] - base.translate[0];
            var diffY = targetTransform.translate[1] - base.translate[1];
            return {
                scale: base.scale + diffScale * ratio,
                translate: [base.translate[0] + diffX * ratio, base.translate[1] + diffY * ratio]
            };
        },

        remove: function(){
            var self = this;
            $.each(this.regions, function(){
                this.remove();
            });
            $.each(this.titles, function(){
                this.remove();
            });
        },
        attr: function(){
            var args = arguments;
            $.each(this.regions, function(){
                this.attr.apply(this, args);
            });
            $.each(this.titles, function(){
                this.attr.apply(this, args);
            });
        },

        /**
         * 获得适合当前地图尺寸的transform
         * @param extScale 额外的缩放比例 默认是1
         */
        getTransform: function(extScale){
            var rect = this.map.viewRect;
            var scale = Math.min(rect.width / this.oriRect.width, rect.height / this.oriRect.height);
            scale = scale * (extScale || 1);
            var newLeft = (rect.width - this.oriRect.width * scale) / 2;
            var newTop = (rect.height - this.oriRect.height * scale) / 2;
            var tx = newLeft - this.oriRect.left * scale  + rect.left;
            var ty = newTop - this.oriRect.top * scale + rect.top;
            return {
                scale: scale,
                translate: [tx, ty]
            };
        },

        /**
         * 这里使用span来创建title, 原因有二个
         * 一是IE下用vml创建的title显示不清楚，二是非常影响动画的性能，使用span后IE下流畅多了
         */
        addTitle: function(){
            var self = this;
            $.each(this.regions, function(){
                var prop = this.data("prop");
                var center = this.data("center");
                var title = prop.name;
                var offset = prop.nameOffset || [0, 0];
                var center = [center[0] + offset[0] * factor, center[1] + offset[1] * factor];
                var node = $('<span/>').addClass('title').text(title).appendTo(self.map.container).css(self.titleStyle);
                var rect = {
                    x : center[0],
                    y : center[1],
                    width: node.outerWidth(),
                    height: node.outerHeight()
                }
                node.css({
                    left: rect.x - rect.width / 2,
                    top: rect.y - rect.height / 2
                });
                node.data('rect', rect).appendTo(self.map.container);
                node.data('region', this);
                self.titles.push(node);
                this.data('title', node);
            });

        },

        transformPosition: function(center){
            return [
                center[0] * this.currentTransform.scale + this.currentTransform.translate[0],
                center[1] * this.currentTransform.scale + this.currentTransform.translate[1],
            ];
        },

        //聚焦当前图层时的样式
        focus: function(){
            $.each(this.regions, function(){
                this.data('mask', false);
            });
        },

        //失焦图层时的样式
        blur: function(){
            $.each(this.regions, function(){
                this.data('mask', true);
            });
        },
    };

    /**
     * 矢量地图类
     * 地图支持的事件 region.mouseover, region.mouseout, region.click
     *
     * @param container 容器
     * @param padding 补白
     */
    function GeoMap(container, padding, options){
        this.container = $(container);
        this.canvas = Canvas.create(this.container);
        padding = $.extend([10,200,10,500], padding);
        this.width = this.container.outerWidth();
        this.height = this.container.outerHeight();
        //地图的显示区域
        this.viewRect = {
            left: padding[3],
            top: padding[0],
            width: this.width - padding[3] - padding[1],
            height: this.height - padding[2] - padding[0]
        };
        this.options = options || {};
        //大地图
        this.mainLayer = null;
        //json数据
        this.json = null;
        //是否正在运行动画
        this.isAnimating = false;
    }

    GeoMap.prototype = {
        //加载json
        load: function(jsonfile, callback){
            var self = this;
            $.ajax({
                url: jsonfile,
                cache: true,
                jsonp: false,
                jsonpCallback: 'c',
                dataType: 'jsonp'
            }).done(function(json){
                self.json = json;
                self.render(callback);
            });
        },

        //渲染地图
        render: function(callback){
            var self = this;
            var l = new Layer(this.json, this, 'china', this.options['mainLayer']);
            l.transform(l.getTransform(5));
            l.animate(l.getTransform(), {
                duration: 1000,
                start: function(){
                    self.isAnimating = true;
                    this.attr('opacity', 0);
                },
                step: function(ratio){
                    this.attr('opacity', ratio);
                },
                end: function(){
                    self.isAnimating = false;
                    callback = callback || $.noop;
                    callback.apply(self);
                }
            });
            this.mainLayer = l;
            this.bindEvent();
        },

        //绑定事件
        bindEvent: function(){
            var self = this;
            this.container.on('mouseover', function(e){
                var region = $(e.target).data('region');
                if(!region){
                    return;
                }

                $(self).triggerHandler('region.mouseover', [region, e.target]);
            });
            this.container.on('mouseout', function(e){
                var region = $(e.target).data('region');
                if(!region){
                    return;
                }
                $(self).triggerHandler('region.mouseout', [region, e.target]);
            });
            this.container.on('click', function(e){
                var region = $(e.target).data('region');
                if(!region){
                    return;
                }
                $(self).triggerHandler('region.click', [region, e.target]);
            });
        },

        //坐标变换
        transformPosition: function(point){
            return this.mainLayer.transformPosition(point);
        }
    };
    window.GeoMap = GeoMap;

})(jQuery);
