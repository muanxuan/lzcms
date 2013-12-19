<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>首页 - 云动机械</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="__PUBLIC__/css/html5reset-1.6.1.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="__PUBLIC__/css/style.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="__PUBLIC__/css/owl.carousel.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="__PUBLIC__/Public/css/owl.theme.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/owl.carousel.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#owl-demo").owlCarousel({
                autoPlay: 3000,
                slideSpeed : 300,
                paginationSpeed : 400,
                item:4,
//                singleItem:true,
                transitionStyle:"fade"
            });
        });
    </script>
</head>
<body>
<div class="header">
    <div class="logo">
        <a href="#">
            <img src="__PUBLIC__/images/logo.png" />
        </a>
    </div>
    <div class="nav-box">
        <div class="nav">
            <ul>
                <li class="active">
                    <a href="__APP__">
                        网站首页
                    </a>
                </li>
                <li>
                    <a href="__APP__/product">
                        产品中心
                    </a>
                </li>
                <li>
                    <a href="__APP__/news">
                        新闻中心
                    </a>
                </li>
                <!--<li>-->
                <!--<a href="http://wei.cmti-fj.com">-->
                <!--施工案例-->
                <!--</a>-->
                <!--</li>-->
                <li>
                    <a href="__APP__/aboutus">
                        联系我们
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
    <div class="banner">
        <div id="owl-demo" class="owl-carousel owl-theme">
            <?php if(is_array($newsBanner)): $i = 0; $__LIST__ = $newsBanner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="item">
                    <p><a href="<?php echo ($data["url"]); ?>"><?php echo ($data["title"]); ?></a></p>
                    <img src="<?php echo ($data["img"]); ?>" alt="<?php echo ($data["title"]); ?>">
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php if(is_array($productBanner)): $i = 0; $__LIST__ = $productBanner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><div class="item">
                    <p><a href="<?php echo ($data["url"]); ?>"><?php echo ($data["title"]); ?></a></p>
                    <img src="<?php echo ($data["img"]); ?>" alt="<?php echo ($data["title"]); ?>">
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <div class="item-header">
        <a href="__APP__/product" class="itm-t">
            <i class="icon-tuijian"></i>新品推荐</a><a href="__APP__/product" class="itm-m">更多</a>
    </div>
    <div class="item-content">
        <ul>
            <?php if(is_array($reProduct)): $i = 0; $__LIST__ = $reProduct;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li>
                <a href="__APP__/product/detail/id/<?php echo ($data["id"]); ?>">
                    <div class="t-img">
                        <img src="<?php echo ($data["img"]); ?>">
                    </div>
                    <div class="t-text">
                        <p class="title">名称：<?php echo ($data["name"]); ?></p>
                        <p><?php echo ($data["type_name"]); ?></p>
                        <p>型号：<?php echo ($data["number"]); ?></p>
                    </div>
                    <div class="more"></div>
                </a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
<div class="item-header">
    <a href="__APP__/product" class="itm-t">
        <i class="icon-tuijian"></i>最新新闻</a><a href="__APP__/news" class="itm-m">更多</a>
</div>
<div class="item-content">
    <ul>
        <?php if(is_array($reArticle)): $i = 0; $__LIST__ = $reArticle;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li>
                <a href="__APP__/news/detail/id/<?php echo ($data["id"]); ?>">
                    <div class="t-img">
                        <img src="<?php echo ($data["img"]); ?>">
                    </div>
                    <div class="t-text">
                        <p class="title">名称：<?php echo ($data["title"]); ?></p>
                        <p><?php echo ($data["type_name"]); ?></p>
                        <p>时间：<?php echo ($data["update_time"]); ?></p>
                    </div>
                    <div class="more"></div>
                </a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>
    <div class="item-header">
        <a href="__APP__/aboutus" class="itm-t">
            <i class="icon-about"></i>关于云动</a><a href="__APP__/aboutus" class="itm-m">更多</a>
    </div>
<div class="index-about">
    <p>福建云动机械有限公司创建于1979年，总部座落于福州工业区。公司总占地面积30多万平方米，员工近千人。是一家生产“云动”牌JGM轮胎式装载机、叉装机、履带式液压挖掘机及其零部件为主营业务的大型专业化工程机械企业。</p>
    <p>云动秉承“以人为本、以诚取信、以质求胜”的经营理念，以做中国精品工程机械提供者为宗旨，致力于打造中国工程机械行业的领军品牌。公司现为“中国驰名商标”、“福建省著名商标”、“福建名牌产品”，中国工程机械装载机行业前10强，中国工程机械制造商50强。良好的品牌形象为公司营销奠定扎实的基础。公司产品销售覆盖全国30个省、市、自治区，现有一级代理商100余家...
    <span>[<a href="__APP__/aboutus">更多</a>]</span></p>
</div>
<div class="footer">
    <ul>
        <li>
            <a href="__APP__">
                网站首页
            </a>
        </li>
        <li>
            <a href="__APP__/product">
                产品中心
            </a>
        </li>
        <li>
            <a href="__APP__/news">
                新闻中心
            </a>
        </li>
        <li>
            <a href="__APP__/aboutus">
                联系我们
            </a>
        </li>
    </ul>
</div>
<div class="footer-content">
    <p>
        福建云动机械有限公司 版权所有
    </p>
    <p>
        <span>地址：福建省福州市工业区</span>
        <span>电话：<a href="tel:0591-83310906">0591-83310906</a></span>
    </p>
</div>
</body>
</html>