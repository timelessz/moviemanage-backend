<?php

namespace App\Http\Controllers\Index;

use App\Element;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Movie;
use App\Movietag;
use App\Movietype;
use Illuminate\Support\Facades\Cache;

class IndexstaticController extends Controller
{

    use pingbaidu;

//    1、站点访问速度
//    2、sitemap
//    3、爬虫爬取更新的数据

    /**
     * 用于生成站点的sitemap 等相关数据
     * @access public
     */
    public function sitemap()
    {
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

    /**
     * 首页静态化相关功能展现
     * @access public
     */
    public function index()
    {
        Cache::flush();
        $element = (new Element())->getIndexEnsstial();
        $code = view('index', $element);
        file_put_contents('index.html', $code);
        return $code;
    }


    //欧美list
    public function oumeilist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('oumei', $id, 20);
        $code = view('movielist', $element);
        return $code;
    }


    //大陆list
    public function dalulist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('dalu', $id, 20);
        $code = view('movielist', $element);
        return $code;
    }

    //rihan list
    public function rihanlist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('rihan', $id, 20);
        $code = view('movielist', $element);
        return $code;
    }


    //港台list
    public function gangtailist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('gangtai', $id, 20);

        $code = view('movielist', $element);
        return $code;
    }

    //经典电影list
    public function jingdianlist($id = 1)
    {
        $element = (new Element())->getMovieListEnsstial('jingdian', $id, 20);
        $code = view('movielist', $element);
        return $code;
    }

    //电影列表
    public function movie($id)
    {
        if (!$id) {
            exit('请求异常');
        }
        $root_url = config('app.root_url');
        $file_name = "movie/movie{$id}.html";
        if (file_exists($file_name)) {
            exit(file_get_contents($file_name));
        }
        //从头获取数据
        $element = (new Element())->getMovieEnsstial($id);
        $code = view('detail', $element);
        file_put_contents($file_name, $code);
        Movie::where('id', $id)->update(['is_static' => '20']);
        //ping百度
        $url = [
            $root_url . '/' . $file_name
        ];
        $this->pingBaidu($url);
        exit($code);
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
        $root_url = config('app.root_url');
        $file_name = "review/review{$id}.html";
        if (file_exists($file_name)) {
            exit(file_get_contents($file_name));
        }
        $element = (new Element())->getReviewEnsstial($id);
        $code = view('reviewdetail', $element);
        file_put_contents($file_name, $code);
        //ping百度
        $url = [
            $root_url . '/' . $file_name
        ];
        $this->pingBaidu($url);
        exit($code);
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
     */
    public function tagmovielist($id = 1, $page = 1)
    {
        //获取分类的id
        $element = (new Element())->getTagMovieListEnsstial($id, $page, 10);
        $code = view('movielist', $element);
        return $code;
    }


    /**
     *
     * 加密：
     * 在完整的下载链接前冠以“AA”，后缀以“ZZ”：
     * AAhttp://hi.baidu.com/yjsword/ZZ
     * 用BASE64算法进行加密，得到：
     * QUFodHRwOi8vaGkuYmFpZHUuY29tL3lqc3dvcmQvWlo=
     * 在前面加上迅雷自己的协议头：
     * thunder://QUFodHRwOi8vaGkuYmFpZHUuY29tL3lqc3dvcmQvWlo=
     * 大功告成！
     *
     *
     *
     */
    public function Download()
    {
        $urlodd = explode('//', $_POST["url"], 2);//把链接分成2段，//前面是第一段，后面的是第二段
        $head = strtolower($urlodd[0]);//PHP对大小写敏感，先统一转换成小写，不然 出现HtTp:或者ThUNDER:这种怪异的写法不好处理
        $behind = $urlodd[1];
        if ($head == "thunder:") {
            $url = substr(base64_decode($behind), 2, -2);//base64解密，去掉前面的AA和后面ZZ
        } elseif ($head == "flashget:") {
            $url1 = explode('&', $behind, 2);
            $url = substr(base64_decode($url1[0]), 10, -10);//base64解密，去掉前面后的[FLASHGET]
        } elseif ($head == "qqdl:") {
            $url = base64_decode($behind);//base64解密
        } elseif ($head == "http:" || $head == "ftp:" || $head == "mms:" || $head == "rtsp:" || $head == "https:") {
            $url = $_POST["url"];//常规地址仅支持http,https,ftp,mms,rtsp传输协议，其他地貌似很少，像XX网盘实际上也是基于base64，但是有的解密了也下载不了
        } else {
            echo "本页面暂时不支持此协议";
        }
        return $url;
    }


    /**
     * 生成base64 下载链接
     * @access public
     */
    public function formDownload()
    {

    }


}



