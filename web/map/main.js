/**
 * @author iceshi
 */

var map = {
    map: null,
    loaded: false,
    pop: null, //hover显示的卡片
    data: null, //区域对应的数据
    option : {
        mainLayer: {
            style: {
                fill: '#f6f6f6',
                stroke: '#e7e7e7'
            },
            titleStyle: {
                color: '#000'
            }
        }
    },
    pinyin: {
        '安徽' : 'anhui',
        '北京': 'beijing',
        '重庆': 'chongqing',
        '福建': 'fujian',
        '甘肃': 'gansu',
        '广东': 'guangdong',
        '广西': 'guangxi',
        '贵州': 'guizhou',
        '海南': 'hainan',
        '河北': 'hebei',
        '黑龙江': 'heilongjiang',
        '河南': 'henan',
        '香港': 'hongkong',
        '湖北': 'hubei',
        '湖南': 'hunan',
        '江苏': 'jiangsu',
        '江西': 'jiangxi',
        '吉林': 'jilin',
        '辽宁': 'liaoning',
        '澳门': 'macao',
        '内蒙古': 'neimenggu',
        '宁夏': 'ningxia',
        '青海': 'qinghai',
        '陕西': 'shaanxi',
        '山东': 'shandong',
        '上海': 'shanghai',
        '山西': 'shanxi',
        '四川': 'sichuan',
        '台湾': 'taiwan',
        '天津': 'tianjin',
        '新疆': 'xinjiang',
        '西藏': 'xizang',
        '云南': 'yunnan',
        '浙江': 'zhejiang'
    },
    init: function(){
        var padding = [0, 0, 0, 0];
        this.map = new GeoMap('.map', padding, this.option);
        this.map.load('./map/china.json', $.proxy(this.bindEvent, this));
        this.pop = $('.pop');
    },
    loadData: function(url){
        url = url || 'map.php';
        $.getJSON(url, $.proxy(this.renderData, this));
    },

    renderData: function(data){
        data && (this.data = data);
        if(!this.loaded || !this.data){
            return false;
        }
        for(var i = 0; i < this.data.length; i++){
            var d = this.data[i];
            var area = this.pinyin[d.name];
            var region = this.map.mainLayer.regions[area];
            this.map.canvas.attr(region, {'fill': d.color});
            //将数据与区域绑定
            region.data('data', this.data[i]);
        }
    },

    bindEvent:  function(){
        var self = this;
        var pop = this.pop;
        //地图加载完成
        this.loaded = true;
        //地图加载完成后再次重新渲染数据
        this.renderData();

        var timer = {};
        $(this.map).on('region.mouseover', function(evt, region, target){
            region.parent().append(region);
            this.canvas.attr(region, {stroke: '#666'});

            if(timer.mouseover){
                clearTimeout(timer.mouseover);
                timer.mouseover = null;
            }
            if(timer.mouseout && pop.data('region') == region){
                clearTimeout(timer.mouseout);
                timer.mouseout = null;
            }
            if(pop.data('region') == region || this.isAnimating){
                return;
            }
            var center = self.getCenter(region);
            var mapOffsetTop = this.container.offset().top;
            timer.mouseover = setTimeout(function(){
                pop.data('region', region);
                self.renderPop(region);
                pop.stop();
                pop.css({
                    left: center[0] - pop.outerWidth() / 2,
                    top: center[1] + mapOffsetTop - pop.outerHeight() - 24 - 50,
                    opacity: 0,
                    display: 'block',
                }).animate({
                    opacity: 1,
                    top: '+=50',
                }, 400);
            }, 300);
        });
        $(this.map).on('region.mouseout', function(evt, region, target){
            this.canvas.attr(region, {stroke: self.option.mainLayer.style.stroke});

            if(timer.mouseover){
                clearTimeout(timer.mouseover);
                timer.mouseover = null;
            }
            if(timer.mouseout){
                clearTimeout(timer.mouseout);
                timer.mouseout = null;
            }
            if(pop.css('display') == 'none' || this.isAnimating){
                return;
            }
            timer.mouseout = setTimeout(function(){
                pop.animate({
                    opacity: 0,
                    top: '-=50',
                }, 400, function(){
                    pop.removeData('region');
                    pop.css('display', 'none');
                });
            }, 300);
        });
        pop.on('mouseover', function(e){
            if(pop.css('opacity') < 1) return;
            $(self).triggerHandler('region.mouseover', [pop.data('region'), e.target]);
        });
        pop.on('mouseout', function(e){
            if(pop.css('opacity') < 1) return;
            $(self).triggerHandler('region.mouseout', [pop.data('region'), e.target]);
        });

        $(this).on('region.click', function(evt, region, target){
            var prop = region.data('prop');
            console.log(region.data('prop').name);
        });
    },

    getCenter: function(region){
        var $title = region.data('title');
        var pos = $title.position();
        var center = [pos.left + $title.outerWidth() / 2, pos.top + $title.outerHeight() / 2];
        return center;
    },

    //显示城市的卡片
    renderPop: function(region){
        var data = region.data('data');
        var html = '<p>最大延迟：' + data.max_delay + 'ms</p>';
        html += '<p>最小延迟：' + data.min_delay + 'ms</p>';
        html += '<p>平抑延迟：' + data.delay + 'ms</p>';
        this.pop.html(html);
    }
};
