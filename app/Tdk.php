<?php

namespace App;


class Tdk
{
    //该模型用于生成页面的tdk 等信息 根据设置的关键词来

    private $main_keyword = [
    ];

    //支持带着占位符
    private $tdk_template = [
        //首页
        'index' => ['title' => '影窝电影-电影天堂_电影下载_免费电影_迅雷电影下载_美剧下载_bt下载_种子下载', 'keywords' => '影窝电影,免费电影下载,电影下载,最新电影,电影天堂', 'description' => '影窝是最好的迅雷电影下载网，分享最新电影，高清电影、综艺、动漫、电视剧、美剧等下载，同时为您提供相关电影影评。'],
        //电影列表
        'gangtai' => ['title' => "香港电影排行榜_好看的香港电影_香港电影国语版/粤语_台湾电影排行榜_台湾电影-", 'keywords' => '香港电影排行榜,好看的香港电影,香港电影国语版,香港电影粤语,台湾电影排行榜,台湾电影网', 'description' => '影窝电影网提供韩国电影,好看的韩国电影,好看的日本电影,日本电影排行榜'],
        'rihan' => ['title' => "韩国电影排行榜_好看的韩国电影_韩国电影推荐_好看的日本电影_日本电影排行-影窝电影", 'keywords' => '韩国电影排行榜,好看的韩国电影,韩国电影,韩国电影推荐,好看的日本电影,日本电影排行榜', 'description' => '影窝电影网提供韩国电影,好看的韩国电影,好看的日本电影,日本电影排行榜'],
        'oumei' => ['title' => '好看的美国电影_美国电影大片_美国电影推荐_欧美电影排行-影窝电影', 'keywords' => '好看的美国电影,美国电影大片,美国电影推荐', 'description' => ''],
        'dalu' => ['title' => '好看的国产电影_最新国产电影排行榜_国产电影推荐_国产电影大片_大陆电影排行榜-影窝电影', 'keywords' => '好看的国产电影,最新国产电影排行榜,国产电影推荐,国产电影大片', 'description' => '影窝电影网提供大陆电影排行榜,好看的国产电影大片，国产电影推荐'],
        'jingdian' => ['title' => '好看的经典电影_经典电影排行榜_经典电影推荐_经典电影大片-影窝电影', 'keywords' => '好看的经典电影,最新经典电影排行榜,经典电影推荐,国产电影大片', 'description' => '迅雷铺电影网提供经典电影排行榜,好看的经典电影大片，经典电影推荐'],
        //电影分类 列表
        'type' => ['title' => '影窝电影-%s电影下载_电影天堂_%s电影迅雷下载_%s免费下载_下载地址', 'keywords' => '%s电影下载,电影天堂,迅雷下载全集,剧情介绍,%s电影下载地址', 'description' => '%s电影迅雷下载、%s电影免费下载全集，在这里您可以获得%s电影的下载地址'],
        //电影分类 列表
        'tag' => ['title' => '影窝电影-%s电影下载_电影天堂_%s电影迅雷下载_%s免费下载_下载地址', 'keywords' => '%s电影下载,电影天堂,迅雷下载全集,剧情介绍,%s电影下载地址', 'description' => '%s电影迅雷下载、%s电影免费下载全集，在这里您可以获得%s电影的下载地址'],
        //电影详情 刀剑神域：序列之争剧场版下载全集高清_迅雷下载_免费下载_下载地址 - 迅雷铺
        'movie' => ['title' => '影窝电影-%s下载_电影天堂_%s迅雷下载_%s免费下载_下载地址', 'keywords' => '%s,电影天堂,迅雷下载全集,剧情介绍,下载地址', 'description' => '%s迅雷下载、%s免费下载全集，在这里您可以免费获得%s的详细剧情介绍,剧照和迅雷高速免费下载地址'],
        //美剧相关
        'meijulist' => ['title' => '', 'keywords' => '', 'description' => ''],
        //美剧列表
        'meiju' => ['title' => '', 'keywords' => '', 'description' => ''],
        //影评列表
        'yingping' => ['title' => '影窝电影热评', 'keywords' => '影窝影评,各类电影剧情介绍,电影图片,预告片,影讯,电影论坛', 'description' => '影窝电影提供最新电影动态，专业电影影评，帮您更好鉴赏电影佳片，电影预告片推荐，给您推荐适合您的电影。'],
        //每一篇影评的tdk
        'review' => ['title' => '%s(影窝)', 'keywords' => '%s影评,%s电影剧情介绍,%s电影图片,%s预告片,%s影讯,%s论坛', 'description' => '%s'],
        //影评
    ];

    /**
     * @access public
     * 获取页面的 tdk
     * @param $current  当前页面的类型
     * @param string $name 页面标题
     * @param string $type 电影类型
     * @param string $desription 页面的描述 从内容中截取一段来
     * @return array|mixed
     */
    public function get_tdk($current, $name = '', $type = '', $desription = '')
    {
        $tdk = [];
        switch ($current) {
            case'index':
                $tdk = $this->tdk_template[$current];
                break;
            case 'gangtai':
                // 菜单的name
                //电影列表相关关键词
                $tdk = $this->tdk_template[$current];
                break;
            case 'rihan':
                $tdk = $this->tdk_template[$current];
                break;
            case 'oumei':
                $tdk = $this->tdk_template[$current];
                break;
            case 'dalu':
                $tdk = $this->tdk_template[$current];
                break;
            case 'jingdian':
                $tdk = $this->tdk_template[$current];
                break;
            case 'movie':
                $tdk = $this->tdk_template[$current];
                $tdk['title'] = str_replace("%s", $name, $tdk['title']);
                $tdk['keywords'] = str_replace("%s", $name, $tdk['keywords']);
                $tdk['description'] = str_replace("%s", $name, $tdk['description']);
                break;
            case 'type':
                $tdk = $this->tdk_template[$current];
                $tdk['title'] = str_replace("%s", $name, $tdk['title']);
                $tdk['keywords'] = str_replace("%s", $name, $tdk['keywords']);
                $tdk['description'] = str_replace("%s", $name, $tdk['description']);
                break;
            case 'meiju':
                break;
            case 'yingping':
                $tdk = $this->tdk_template[$current];
                break;
            case 'review':
                $tdk = $this->tdk_template[$current];
                $tdk['title'] = str_replace("%s", $name, $tdk['title']);
                $tdk['keywords'] = str_replace("%s", $name, $tdk['keywords']);
                $tdk['description'] = str_replace("%s", $name, $tdk['description']);
                break;
            case 'tag':
                $tdk = $this->tdk_template[$current];
                $tdk['title'] = str_replace("%s", $name, $tdk['title']);
                $tdk['keywords'] = str_replace("%s", $name, $tdk['keywords']);
                $tdk['description'] = str_replace("%s", $name, $desription);
                break;
        }
        return $this->get_tdk_html($tdk);
    }

    /**
     *获取爬虫相关的html 数据
     * @access private
     * @param $title
     * @param $keyword
     * @param $description
     * @return string
     */
    private function get_tdk_html($tdk)
    {
        list($title, $keyword, $description) = array_values($tdk);
        $title_template = "<title>%s</title>";
        $keywords_template = "<meta name='keywords' content='%s'>";
        $description_template = "<meta name='description' content='%s'>";
        return sprintf($title_template, $title) . sprintf($keywords_template, $keyword) . sprintf($description_template, $description);
    }

}
