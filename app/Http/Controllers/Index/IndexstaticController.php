<?php

namespace App\Http\Controllers\Index;

use App\Element;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Movietag;
use App\Movietype;

class IndexstaticController extends Controller
{

//    1、站点访问速度
//    2、sitemap
//    3、爬虫爬取更新的数据

    /**
     * 用于生成站点的sitemap 等相关数据
     * @access public
     */
    public function sitemap()
    {
        echo '<pre>';
        $host = 'http://www.' . $_SERVER['HTTP_HOST'];
        //首先获取全部链接的路径 从menu 中
        $menu = (new Menu())->get_menu();
//        print_r($menu);
        //然后需要获取全部的电影分类 点一个标签的信息
        $movietype = Movietype::all(['id', 'name'])->toArray();
        $movietag = Movietag::all(['id', 'name'])->toArray();
        array_walk($movietype, [(new Element()), 'execFormatTagType'], 'type');
        array_walk($movietag, [(new Element()), 'execFormatTagType'], 'tag');
        $sitemap = [];
        foreach ($menu as $v) {
            $sitemap[] = [
                'loc' => $host . $v['path'],
                'lastmod' => date('Y-m-d', time()),
                'changefreq' => 'hourly',
                'priority' => $v['priority'],
            ];
        }
        foreach ($movietag as $v) {
            $sitemap[] = [
                'loc' => $host . $v['href'],
                'lastmod' => date('Y-m-d', time()),
                'changefreq' => 'daily',
                'priority' => '0.6',
            ];
        }
        foreach ($movietype as $v) {
            $sitemap[] = [
                'loc' => $host . $v['href'],
                'lastmod' => date('Y-m-d', time()),
                'changefreq' => 'daily',
                'priority' => '0.6',
            ];
        }
        $xml_wrapper = <<<XML
<?xml version='1.0' encoding='utf-8'?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
</urlset>
XML;
        $xml = new \SimpleXMLElement($xml_wrapper);
        foreach ($sitemap as $data) {
            $item = $xml->addChild('url'); //使用addChild添加节点
            if (is_array($data)) {
                foreach ($data as $key => $row) {
                    $item->addChild($key, $row);
                }
            }
        }
        $xmldata = $xml->asXML(); //用asXML方法输出xml，默认只构造不输出。
        file_put_contents('sitemap.xml', $xmldata);
    }


    //
    public function index()
    {
        $element = (new Element())->getIndexEnsstial();
        $code = view('index', $element);
        file_put_contents('index.html', $code);
        return $code;
    }


    //欧美list
    public function oumeilist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('oumei', $id, 10);
        $code = view('movielist', $element);
        return $code;
    }


    //大陆list
    public function dalulist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('dalu', $id, 10);
        $code = view('movielist', $element);
        return $code;
    }

    //rihan list
    public function rihanlist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('rihan', $id, 10);
        $code = view('movielist', $element);
        return $code;
        return view('movielist');
    }


    //港台list
    public function gangtailist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('gangtai', $id, 10);
        $code = view('movielist', $element);
        return $code;
    }

    //经典电影list
    public function jingdianlist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('jingdian', $id, 10);
        $code = view('movielist', $element);
        return $code;
    }

    //
    public function movie($id)
    {
        if (!$id) {
            exit('请求异常');
        }
        //从头获取数据
        $element = (new Element())->getMovieEnsstial($id);
        $code = view('detail', $element);
        return $code;
    }

    //影评list
    public function yingpinglist($id = 1)
    {
        $element = (new Element())->getYingpingListEnsstial($id, 10);
        $code = view('reviewlist', $element);
        return $code;
    }

    /**
     * 电影影评
     * @access public
     */
    public function review($id)
    {
        if (!$id) {
            exit('请求异常');
        }
        //从头获取数据
        $element = (new Element())->getReviewEnsstial($id);
        $code = view('reviewdetail', $element);
        return $code;
    }

    /**
     * 标签的 列表
     */
    public function taglist()
    {
        //从头获取数据
        $element = (new Element())->getTagTypeEnsstial();
        $code = view('tagtypelist', $element);
        return $code;
    }

    /**
     * 标签的 列表
     */
    public function typelist()
    {
        //从头获取数据
        $element = (new Element())->getTagTypeEnsstial('type');
        $code = view('tagtypelist', $element);
        return $code;
    }

    /**
     * 根据电影分类来展现电影
     *
     */
    public function typemovielist($id = 1, $page = 1)
    {
        //获取分类的id
        $element = (new Element())->getTypeMovieListEnsstial($id, $page, 10);
        $code = view('movielist', $element);
        return $code;
    }


    /**
     * 根据电影标志来展现电影
     *
     */
    public function tagmovielist($id = 1, $page = 1)
    {
        //获取分类的id
        $element = (new Element())->getTagMovieListEnsstial($id, $page, 10);
        $code = view('movielist', $element);
        return $code;
    }


}
