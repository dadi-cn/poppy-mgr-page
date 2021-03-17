<?php

namespace Poppy\Faker\Provider\zh_CN;

class Address extends \Poppy\Faker\Provider\Address
{

    protected static $cites = [
        '北京', '上海', '天津', '重庆',
        '哈尔滨', '长春', '沈阳', '呼和浩特',
        '石家庄', '乌鲁木齐', '兰州', '西宁',
        '西安', '银川', '郑州', '济南',
        '太原', '合肥', '武汉', '长沙',
        '南京', '成都', '贵阳', '昆明',
        '南宁', '拉萨', '杭州', '南昌',
        '广州', '福州', '海口',
        '香港', '澳门',
    ];

    protected static $states = [
        '北京市', '天津市', '河北省', '山西省',
        '内蒙古自治区', '辽宁省', '吉林省',
        '黑龙江省', '上海市', '江苏省',
        '浙江省', '安徽省', '福建省', '江西省',
        '山东省', '河南省', '湖北省', '湖南省',
        '广东省', '广西壮族自治区', '海南省',
        '重庆市', '四川省', '贵州省', '云南省',
        '西藏自治区', '陕西省', '甘肃省', '青海省',
        '宁夏回族自治区', '新疆维吾尔自治区',
        '香港特别行政区', '澳门特别行政区', '台湾省',
    ];

    protected static $stateAbbr = [
        '京', '皖', '渝', '闽',
        '甘', '粤', '桂', '黔',
        '琼', '冀', '豫', '黑',
        '鄂', '湘', '吉', '苏',
        '赣', '辽', '蒙', '宁',
        '青', '鲁', '晋', '陕',
        '沪', '川', '津', '藏',
        '新', '滇', '浙', '港',
        '澳', '台',
    ];

    protected static $areas = [
        '西夏区', '永川区', '秀英区', '高港区',
        '清城区', '兴山区', '锡山区', '清河区',
        '龙潭区', '华龙区', '海陵区', '滨城区',
        '东丽区', '高坪区', '沙湾区', '平山区',
        '城北区', '海港区', '沙市区', '双滦区',
        '长寿区', '山亭区', '南湖区', '浔阳区',
        '南长区', '友好区', '安次区', '翔安区',
        '沈河区', '魏都区', '西峰区', '萧山区',
        '金平区', '沈北新区', '孝南区', '上街区',
        '城东区', '牧野区', '大东区', '白云区',
        '花溪区', '吉利区', '新城区', '怀柔区',
        '六枝特区', '涪城区', '清浦区', '南溪区',
        '淄川区', '高明区', '金水区', '中原区',
        '高新开发区', '经济开发新区', '新区',
    ];

    protected static $country = [
        '阿富汗', '阿拉斯加', '阿尔巴尼亚', '阿尔及利亚',
        '安道尔', '安哥拉', '安圭拉岛英', '安提瓜和巴布达',
        '阿根廷', '亚美尼亚', '阿鲁巴岛', '阿森松', '澳大利亚',
        '奥地利', '阿塞拜疆', '巴林', '孟加拉国', '巴巴多斯',
        '白俄罗斯', '比利时', '伯利兹', '贝宁', '百慕大群岛',
        '不丹', '玻利维亚', '波斯尼亚和黑塞哥维那', '博茨瓦纳',
        '巴西', '保加利亚', '布基纳法索', '布隆迪', '喀麦隆',
        '加拿大', '加那利群岛', '佛得角', '开曼群岛', '中非',
        '乍得', '智利', '圣诞岛', '科科斯岛', '哥伦比亚',
        '巴哈马国', '多米尼克国', '科摩罗', '刚果', '科克群岛',
        '哥斯达黎加', '克罗地亚', '古巴', '塞浦路斯', '捷克',
        '丹麦', '迪戈加西亚岛', '吉布提', '多米尼加共和国',
        '厄瓜多尔', '埃及', '萨尔瓦多', '赤道几内亚',
        '厄立特里亚', '爱沙尼亚', '埃塞俄比亚', '福克兰群岛',
        '法罗群岛', '斐济', '芬兰', '法国', '法属圭亚那',
        '法属波里尼西亚', '加蓬', '冈比亚', '格鲁吉亚', '德国',
        '加纳', '直布罗陀', '希腊', '格陵兰岛', '格林纳达',
        '瓜德罗普岛', '关岛', '危地马拉', '几内亚', '几内亚比绍',
        '圭亚那', '海地', '夏威夷', '洪都拉斯', '匈牙利', '冰岛',
        '印度', '印度尼西亚', '伊郎', '伊拉克', '爱尔兰', '以色列',
        '意大利', '科特迪瓦', '牙买加', '日本', '约旦', '柬埔塞',
        '哈萨克斯坦', '肯尼亚', '基里巴斯', '朝鲜', '韩国', '科威特',
        '吉尔吉斯斯坦', '老挝', '拉脱维亚', '黎巴嫩', '莱索托',
        '利比里亚', '利比亚', '列支敦士登', '立陶宛', '卢森堡',
        '马其顿', '马达加斯加', '马拉维', '马来西亚', '马尔代夫',
        '马里', '马耳他', '马里亚纳群岛', '马绍尔群岛', '马提尼克',
        '毛里塔尼亚', '毛里求斯', '马约特岛', '墨西哥', '密克罗尼西亚',
        '中途岛', '摩尔多瓦', '摩纳哥', '蒙古', '蒙特塞拉特岛',
        '摩洛哥', '莫桑比克', '缅甸', '纳米比亚', '瑙鲁', '尼泊尔',
        '荷兰', '荷属安的列斯群岛', '新喀里多尼亚群岛', '新西兰',
        '尼加拉瓜', '尼日尔', '尼日利亚', '纽埃岛', '诺福克岛',
        '挪威', '阿曼', '帕劳', '巴拿马', '巴布亚新几内亚', '巴拉圭',
        '秘鲁', '菲律宾', '波兰', '葡萄牙', '巴基斯坦', '波多黎各',
        '卡塔尔', '留尼汪岛', '罗马尼亚', '俄罗斯', '卢旺达',
        '东萨摩亚', '西萨摩亚', '圣马力诺', '圣皮埃尔岛及密克隆岛',
        '圣多美和普林西比', '沙特阿拉伯', '塞内加尔', '塞舌尔',
        '新加坡', '斯洛伐克', '斯洛文尼亚', '所罗门群岛', '索马里',
        '南非', '西班牙', '斯里兰卡', '圣克里斯托弗和尼维斯',
        '圣赫勒拿', '圣卢西亚', '圣文森特岛', '苏丹', '苏里南',
        '斯威士兰', '瑞典', '瑞士', '叙利亚', '塔吉克斯坦', '坦桑尼亚',
        '泰国', '阿拉伯联合酋长国', '多哥', '托克劳群岛', '汤加',
        '特立尼达和多巴哥', '突尼斯', '土耳其', '土库曼斯坦',
        '特克斯和凯科斯群岛(', '图瓦卢', '美国', '乌干达', '乌克兰',
        '英国', '乌拉圭', '乌兹别克斯坦', '瓦努阿图', '梵蒂冈',
        '委内瑞拉', '越南', '维尔京群岛', '维尔京群岛和圣罗克伊',
        '威克岛', '瓦里斯和富士那群岛', '西撒哈拉', '也门', '南斯拉夫',
        '扎伊尔', '赞比亚', '桑给巴尔', '津巴布韦', '中华人民共和国', '中国',
    ];

    public function city()
    {
        return static::randomElement(static::$cites);
    }

    public function state()
    {
        return static::randomElement(static::$states);
    }

    public function stateAbbr()
    {
        return static::randomElement(static::$stateAbbr);
    }

    public static function area()
    {
        return static::randomElement(static::$areas);
    }

    public static function country()
    {
        return static::randomElement(static::$country);
    }

    public function address()
    {
        return $this->city() . static::area();
    }

    public static function postcode()
    {
        $prefix = str_pad(mt_rand(1, 85), 2, 0, STR_PAD_LEFT);
        $suffix = '00';

        return $prefix . mt_rand(10, 88) . $suffix;
    }
}