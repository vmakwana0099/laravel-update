<?php

/**
 * The MenuBuilder class generates dynamic menu
 * configuration  process (ORM code Updates).
 * @package   Netquick powerpanel
 * @license   http://www.opensource.org/licenses/BSD-3-Clause
 * @version   1.1
 * @since     2017-08-09
 * @author    NetQuick
 */

namespace App\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Jenssegers\Agent\Agent;
use Lavary\Menu\Menu;
use App\Menu as Menus;
use App\MenuType;
use App\Helpers\MyLibrary;
use Config;

class MenuBuilder {

    public static $arrMenu = false;

    /**
     * This method loads dynamic menu
     * @return  Menu array
     * @since   2017-08-09
     * @author  NetQuick
     */
    public static function loadMenu($menu_content = null, $name = null) {
        $menu = new Menu;
        if ($menu_content != null) {
            $menu->make($name, function($menu) use($menu_content, $name) {
                $arrData = self::getMenuArray($menu_content, 0, $menu, $name);
            });
        }
    }

    /**
     * This method generates menu data for dynamic menu
     * @return  Menu array
     * @since   2017-08-09
     * @author  NetQuick
     */
    public static function getMenuArray($elements = false, $parentId = 0, $menu = false, $name = false) {
        $agent = new Agent;
        $parentCheck = array();
        $parentMegaMenu = [];
        $branch = array();
        foreach ($elements as $element) {

            if (($agent->isMobile() && $element->chrInMobile == 'Y') || (!$agent->isMobile() && $element->chrInWeb == 'Y')) {
                foreach ($elements as $row) {
                    if ($row->id == $element->intParentMenuId) {
                        if ($row->chrMegaMenu == 'Y') {

                            array_push($parentMegaMenu, $element->intParentMenuId);
                        }
                    }
                }
                if ($element->intParentMenuId == $parentId) {
                    $attr = array();

                    if (in_array($element->id, $parentCheck)) {
                        $attr['class'] = 'dropdown';
                        $arrAttr['class'] = 'dropdown-toggle';
                        if ($element->chrMegaMenu == 'Y') {
                            $attr['class'].=' megamenu ';
                        }
                    }
                    if (in_array($element->intParentMenuId, $parentMegaMenu)) {
                        $inMegamenu = 'Y';
                    } else {
                        $inMegamenu = 'N';
                    }

                    $url = $element->txtPageUrl;
                    $title = $element->varTitle;
                    if (strtolower($title) == 'home' && $element->intPosition == 1) {
                        $title = 'Home';
                    }
                    if ($element->id != '3') {
                        if ($element->id == '1') {
                            $Mobile_Menu_Icon = "menu-home";
                        } else if ($element->id == '2') {
                            $Mobile_Menu_Icon = "menu-domain";
                        } else if ($element->id == '3') {
                            $Mobile_Menu_Icon = "menu-hosting";
                        } else if ($element->id == '4') {
                            $Mobile_Menu_Icon = "menu-website";
                        } else if ($element->id == '5') {
                            $Mobile_Menu_Icon = "menu-ssl";
                        } else if ($element->id == '6') {
                            $Mobile_Menu_Icon = "menu-deals";
                        } else {
                            $Mobile_Menu_Icon = "";
                        }
                        if (in_array($element->id, $parentCheck)) {
                            $subMenu = $menu->add($title, $attr)->active($element->txtPageUrl . '/*')->prepend('<i class="' . $Mobile_Menu_Icon . '"></i>')->prepend('<i class="la la-plus plus-icon"></i>');
                        } else {
                            $subMenu = $menu->add($title, $attr)->active($element->txtPageUrl . '/*')->prepend('<i class="' . $Mobile_Menu_Icon . '"></i>');
//                                ->after(view('template.mobilemenu'));
                        }
                    }

//                    $menu->websites->divide();
//                    $menu->get('websites')->divide();




                    $arrAttr = array();
                    if ($element->intPosition == 1 || $element->intPosition == 2 || $element->intPosition == 5 || $element->intPosition == 4 || $element->intPosition == 6) {
//						$arrAttr['class']='link';

                        if (in_array($element->id, $parentCheck)) {

                            $arrAttr['class'] = 'dropdown-toggle';
                            $arrAttr['data-toggle'] = 'dropdown';
                        }

                        if (Request::segment(1) == $url || (strlen(Request::segment(1)) < 1 && strtolower($element->varTitle) == 'home')) {
                            $arrAttr['class'] = 'active link';
                        }
                        if (Request::segment(2) == 'thankyou') {
                            $arrAttr['class'] = 'link';
                        }
                        if ($url == Request::segment(1) . '/' . Request::segment(2)) {
                            $arrAttr['class'] = 'active link';
                        }

                        if (Request::segment(1) . '/' . Request::segment(2) . '/' . Request::segment(3) . '/' . Request::segment(4) == $url) {
                            $arrAttr['class'] = 'active link';
                        }
                    }
                    $arrAttr['id'] = $element->id;
                    $arrAttr['data-parentId'] = $element->intParentMenuId;
                    $arrAttr['data-order'] = $element->intItemOrder;
                    $arrAttr['data-orderParent'] = $element->intParentItemOrder;
                    $arrAttr['title'] = $element->varTitle;
                    $arrAttr['data-chrMegaMenu'] = $element->chrMegaMenu;
                    $arrAttr['data-inMegamenu'] = $inMegamenu;

                    //$isParent = Menus::getRecords()->deleted()->publish()->active()->checkParentRecordId($element->id)->first();
                    if ($element->intParentMenuId == 0) {
                        //$arrAttr['class']=($inMegamenu == 'N')?'dropdown-toggle link':' link';
                        if (
                                Request::segment(1) == $url ||
                                Request::segment(1) . '/' . Request::segment(2) == $url ||
                                Request::segment(1) . '/' . Request::segment(2) . '/' . Request::segment(3) == $url ||
                                (strlen(Request::segment(1)) < 1 && strtolower($element->varTitle) == 'home')) {
//                            $arrAttr['class'] = ($inMegamenu == 'N') ? 'dropdown-toggle active link' : ' active link';
                        }
                    }
                    if (filter_var($url, FILTER_VALIDATE_URL)) {
                        $arrAttr['href'] = $url;
                    } else {
                        $arrAttr['href'] = url($url);
                    }


                    // set megamenu file
                    if ($element->chrMegaMenu == 'Y') {

                        $megamenudata = Menus::getMegaMenuData();
                        $P = 1;
                        foreach ($megamenudata as $value) {

                            $HostingParam = array('duration' => 'monthly', 'productid' => $P, 'action' => 'getminprice', 'currencycode' => Config::get('Constant.Currency'));
                            $HostingPlanData[$P] = MyLibrary::laravelcallapi("getminprice", $HostingParam);
                            $value->price= $HostingPlanData[$P][Config::get('Constant.Currency')]['monthly'];
                            $P++;
                            $productdata[] = $value;
                        }
                   
                        $menu->add("Hosting", ['title' => 'Hosting', 'class' => 'dropdown megamenu'])
                                ->after(view('template.megamenu')->with('data', $productdata))
                                ->prepend('<i class="menu-hosting"></i>')
                                ->prepend('<i class="la la-plus plus-icon"></i>')
                        ->link->attr($arrAttr);
                    } else {
                        $subMenu->link->attr($arrAttr);
                        $children = self::getMenuArray($elements, $element->id, $subMenu);
                        if ($children) {

                            $element->children = $children;
                        }
                        $branch[] = $element;
                    }

//                    $subMenu->link->attr($arrAttr);
//                    $children = self::getMenuArray($elements, $element->id, $subMenu);
//                    if ($children) {
//
//                        $element->children = $children;
//                    }
//                    $branch[] = $element;
                    if ($element->id == '6' && $agent->isMobile()) {
                        $menu->add("", ['title' => '', 'class' => ''])
                                ->after(view('template.mobilemenu'));
                    }
                }

                foreach ($elements as $row) {
//                    if ($row->chrMegaMenu == 'Y') {
//                         $menu->append('<ul><li>test</li></ul>');
//                    } else {
//                        if ($row->id == $element->intParentMenuId) {
//                            array_push($parentCheck, $element->intParentMenuId);
//                        }
//                    }
                    if ($row->id == $element->intParentMenuId) {
                        array_push($parentCheck, $element->intParentMenuId);
                    }
                }

//                echo $menu->last();
            }
        }

        return $branch;
    }

}
