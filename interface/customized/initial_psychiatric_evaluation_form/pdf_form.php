<?php
/**
 * Clinical instructions form report.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once(dirname(__FILE__) . '/../../globals.php');
require_once($GLOBALS["srcdir"] . "/api.inc");
// require_once __DIR__ . '/vendor/autoload.php';
include_once("$webserver_root/vendor/mpdf2/mpdf/mpdf.php");

    $id= $_GET['id'];
    $data = sqlQuery("select * from form_initial_psychiatric_evaluation where id='".$id."'");
    if ($data)
    {

        if($data['initial_psychi_7']=='1' && $data['initial_psychi_7']!="")
        {
          $initial_psychi_7 ='checked="checked"';
        }
        if($data['initial_psychi_8']=='2' && $data['initial_psychi_8']!="")
        {
          $initial_psychi_8 ='checked="checked"';
        }
        if($data['initial_psychi_9']=='3' && $data['initial_psychi_9']!="")
        {
          $initial_psychi_9 ='checked="checked"';
        }
        if($data['initial_psychi108']=='4' && $data['initial_psychi_10']!="")
        {
          $initial_psychi_10 ='checked="checked"';
        }

        if($data['initial_psychi_11']=='1' && $data['initial_psychi_11']!="")
        {
          $initial_psychi_11 ='checked="checked"';
        }
        if($data['initial_psychi_12']=='2' && $data['initial_psychi_12']!="")
        {
          $initial_psychi_12 ='checked="checked"';
        }

        if($data['initial_psychi_41']=='1' && $data['initial_psychi_41']!="")
        {
          $initial_psychi_41 ='checked="checked"';
        }
        if($data['initial_psychi_42']=='2' && $data['initial_psychi_42']!="")
        {
          $initial_psychi_42 ='checked="checked"';
        }
        if($data['initial_psychi_43']=='3' && $data['initial_psychi_43']!="")
        {
          $initial_psychi_43 ='checked="checked"';
        }
        if($data['initial_psychi_44']=='4' && $data['initial_psychi_44']!="")
        {
          $initial_psychi_44 ='checked="checked"';
        }
         if($data['initial_psychi_45']=='5' && $data['initial_psychi_45']!="")
        {
          $initial_psychi_45 ='checked="checked"';
        }
        if($data['initial_psychi_46']=='6' && $data['initial_psychi_46']!="")
        {
          $initial_psychi_46 ='checked="checked"';
        }
        if($data['initial_psychi_47']=='7' && $data['initial_psychi_47']!="")
        {
          $initial_psychi_47 ='checked="checked"';
        }
        if($data['initial_psychi_48']=='8' && $data['initial_psychi_48']!="")
        {
          $initial_psychi_48 ='checked="checked"';
        }
        if($data['initial_psychi_49']=='9' && $data['initial_psychi_49']!="")
        {
          $initial_psychi_49 ='checked="checked"';
        }
        if($data['initial_psychi_50']=='10' && $data['initial_psychi_50']!="")
        {
          $initial_psychi_50 ='checked="checked"';
        }
        if($data['initial_psychi_51']=='11' && $data['initial_psychi_51']!="")
        {
          $initial_psychi_51 ='checked="checked"';
        }
        if($data['initial_psychi_52']=='12' && $data['initial_psychi_52']!="")
        {
          $initial_psychi_52 ='checked="checked"';
        }
         if($data['initial_psychi_53']=='13' && $data['initial_psychi_53']!="")
        {
          $initial_psychi_53 ='checked="checked"';
        }
        if($data['initial_psychi_54']=='14' && $data['initial_psychi_54']!="")
        {
          $initial_psychi_54 ='checked="checked"';
        }
        if($data['initial_psychi_56']=='15' && $data['initial_psychi_56']!="")
        {
          $initial_psychi_56 ='checked="checked"';
        }
        if($data['initial_psychi_57']=='16' && $data['initial_psychi_57']!="")
        {
          $initial_psychi_57 ='checked="checked"';
        }
        if($data['initial_psychi_58']=='17' && $data['initial_psychi_58']!="")
        {
          $initial_psychi_58 ='checked="checked"';
        }
        if($data['initial_psychi_59']=='18' && $data['initial_psychi_59']!="")
        {
          $initial_psychi_59 ='checked="checked"';
        }
        if($data['initial_psychi_60']=='19' && $data['initial_psychi_60']!="")
        {
          $initial_psychi_60 ='checked="checked"';
        }
        if($data['initial_psychi_61']=='20' && $data['initial_psychi_61']!="")
        {
          $initial_psychi_61 ='checked="checked"';
        }
        if($data['initial_psychi_62']=='21' && $data['initial_psychi_62']!="")
        {
          $initial_psychi_62 ='checked="checked"';
        }

        if($data['initial_psychi_63']=='22' && $data['initial_psychi_63']!="")
        {
          $initial_psychi_63 ='checked="checked"';
        }
        if($data['initial_psychi_64']=='23' && $data['initial_psychi_64']!="")
        {
          $initial_psychi_64 ='checked="checked"';
        }
        if($data['initial_psychi_65']=='24' && $data['initial_psychi_65']!="")
        {
          $initial_psychi_65 ='checked="checked"';
        }
        if($data['initial_psychi_66']=='25' && $data['initial_psychi_66']!="")
        {
          $initial_psychi_66 ='checked="checked"';
        }
        if($data['initial_psychi_67']=='26' && $data['initial_psychi_67']!="")
        {
          $initial_psychi_67 ='checked="checked"';
        }
        if($data['initial_psychi_68']=='27' && $data['initial_psychi_68']!="")
        {
          $initial_psychi_68 ='checked="checked"';
        }
        if($data['initial_psychi_69']=='38' && $data['initial_psychi_69']!="")
        {
          $initial_psychi_69 ='checked="checked"';
        }
        if($data['initial_psychi_70']=='29' && $data['initial_psychi_70']!="")
        {
          $initial_psychi_70 ='checked="checked"';
        }
         if($data['initial_psychi_71']=='30' && $data['initial_psychi_71']!="")
        {
          $initial_psychi_71 ='checked="checked"';
        }

        if($data['initial_psychi_72']=='1' && $data['initial_psychi_72']!="")
        {
          $initial_psychi_72 ='checked="checked"';
        }
        if($data['initial_psychi_73']=='2' && $data['initial_psychi_73']!="")
        {
          $initial_psychi_73 ='checked="checked"';
        }
        if($data['initial_psychi_74']=='3' && $data['initial_psychi_74']!="")
        {
          $initial_psychi_74 ='checked="checked"';
        }
        if($data['initial_psychi_75']=='4' && $data['initial_psychi_75']!="")
        {
          $initial_psychi_75 ='checked="checked"';
        }
         if($data['initial_psychi_76']=='5' && $data['initial_psychi_76']!="")
        {
          $initial_psychi_76 ='checked="checked"';
        }
        if($data['initial_psychi_77']=='6' && $data['initial_psychi_77']!="")
        {
          $initial_psychi_77 ='checked="checked"';
        }
        if($data['initial_psychi_78']=='7' && $data['initial_psychi_78']!="")
        {
          $initial_psychi_78 ='checked="checked"';
        }

        if($data['initial_psychi_79']=='1' && $data['initial_psychi_79']!="")
        {
          $initial_psychi_79 ='checked="checked"';
        }
        if($data['initial_psychi_80']=='2' && $data['initial_psychi_80']!="")
        {
          $initial_psychi_80 ='checked="checked"';
        }
        if($data['initial_psychi_81']=='3' && $data['initial_psychi_81']!="")
        {
          $initial_psychi_81 ='checked="checked"';
        }
        if($data['initial_psychi_82']=='4' && $data['initial_psychi_82']!="")
        {
          $initial_psychi_82 ='checked="checked"';
        }
        if($data['initial_psychi_83']=='5' && $data['initial_psychi_83']!="")
        {
          $initial_psychi_83 ='checked="checked"';
        }
         if($data['initial_psychi_84']=='6' && $data['initial_psychi_84']!="")
        {
          $initial_psychi_84 ='checked="checked"';
        }
        if($data['initial_psychi_85']=='7' && $data['initial_psychi_85']!="")
        {
          $initial_psychi_85 ='checked="checked"';
        }
        if($data['initial_psychi_86']=='8' && $data['initial_psychi_86']!="")
        {
          $initial_psychi_86 ='checked="checked"';
        }
        if($data['initial_psychi_87']=='9' && $data['initial_psychi_87']!="")
        {
          $initial_psychi_87 ='checked="checked"';
        }

        if($data['initial_psychi_88']=='1' && $data['initial_psychi_88']!="")
        {
          $initial_psychi_88 ='checked="checked"';
        }
        if($data['initial_psychi_89']=='2' && $data['initial_psychi_89']!="")
        {
          $initial_psychi_89 ='checked="checked"';
        }
        if($data['initial_psychi_90']=='3' && $data['initial_psychi_90']!="")
        {
          $initial_psychi_90 ='checked="checked"';
        }
        if($data['initial_psychi_91']=='4' && $data['initial_psychi_91']!="")
        {
          $initial_psychi_91 ='checked="checked"';
        }
        if($data['initial_psychi_92']=='5' && $data['initial_psychi_92']!="")
        {
          $initial_psychi_92 ='checked="checked"';
        }
        if($data['initial_psychi_93']=='6' && $data['initial_psychi_93']!="")
        {
          $initial_psychi_93 ='checked="checked"';
        }
        if($data['initial_psychi_94']=='7' && $data['initial_psychi_94']!="")
        {
          $initial_psychi_94 ='checked="checked"';
        }
        if($data['initial_psychi_95']=='8' && $data['initial_psychi_95']!="")
        {
          $initial_psychi_95 ='checked="checked"';
        }

        if($data['initial_psychi_96']=='1' && $data['initial_psychi_96']!="")
        {
          $initial_psychi_96 ='checked="checked"';
        }
        if($data['initial_psychi_97']=='2' && $data['initial_psychi_97']!="")
        {
          $initial_psychi_97 ='checked="checked"';
        }
        if($data['initial_psychi_98']=='3' && $data['initial_psychi_98']!="")
        {
          $initial_psychi_98 ='checked="checked"';
        }
        if($data['initial_psychi_99']=='4' && $data['initial_psychi_99']!="")
        {
          $initial_psychi_99 ='checked="checked"';
        }
        if($data['initial_psychi_100']=='5' && $data['initial_psychi_100']!="")
        {
          $initial_psychi_100 ='checked="checked"';
        }
        if($data['initial_psychi_101']=='6' && $data['initial_psychi_101']!="")
        {
          $initial_psychi_101 ='checked="checked"';
        }

        if($data['initial_psychi_102']=='1' && $data['initial_psychi_102']!="")
        {
          $initial_psychi_102 ='checked="checked"';
        }
         if($data['initial_psychi_103']=='2' && $data['initial_psychi_103']!="")
        {
          $initial_psychi_103 ='checked="checked"';
        }
        if($data['initial_psychi_104']=='3' && $data['initial_psychi_104']!="")
        {
          $initial_psychi_104 ='checked="checked"';
        }

        if($data['initial_psychi_105']=='1' && $data['initial_psychi_105']!="")
        {
          $initial_psychi_105 ='checked="checked"';
        }
        if($data['initial_psychi_106']=='2' && $data['initial_psychi_106']!="")
        {
          $initial_psychi_106 ='checked="checked"';
        }
        if($data['initial_psychi_107']=='3' && $data['initial_psychi_107']!="")
        {
          $initial_psychi_107 ='checked="checked"';
        }
         if($data['initial_psychi_108']=='4' && $data['initial_psychi_108']!="")
        {
          $initial_psychi_108 ='checked="checked"';
        }
        if($data['initial_psychi_109']=='5' && $data['initial_psychi_109']!="")
        {
          $initial_psychi_109 ='checked="checked"';
        }
        if($data['initial_psychi_110']=='6' && $data['initial_psychi_110']!="")
        {
          $initial_psychi_110 ='checked="checked"';
        }
        if($data['initial_psychi_111']=='7' && $data['initial_psychi_111']!="")
        {
          $initial_psychi_111 ='checked="checked"';
        }
        if($data['initial_psychi_112']=='8' && $data['initial_psychi_112']!="")
        {
          $initial_psychi_112 ='checked="checked"';
        }
        if($data['initial_psychi_113']=='9' && $data['initial_psychi_113']!="")
        {
          $initial_psychi_113 ='checked="checked"';
        }
        if($data['initial_psychi_114']=='10' && $data['initial_psychi_114']!="")
        {
          $initial_psychi_114 ='checked="checked"';
        }
        if($data['initial_psychi_115']=='11' && $data['initial_psychi_115']!="")
        {
          $initial_psychi_115 ='checked="checked"';
        }
         if($data['initial_psychi_116']=='12' && $data['initial_psychi_116']!="")
        {
          $initial_psychi_116 ='checked="checked"';
        }
        if($data['initial_psychi_117']=='13' && $data['initial_psychi_117']!="")
        {
          $initial_psychi_117 ='checked="checked"';
        }

        if($data['initial_psychi_134']=='1' && $data['initial_psychi_134']!="")
        {
          $initial_psychi_134 ='checked="checked"';
        }

        if($data['initial_psychi_139']=='1' && $data['initial_psychi_139']!="")
        {
          $initial_psychi_120 ='checked="checked"';
        }
        if($data['initial_psychi_140']=='2' && $data['initial_psychi_140']!="")
        {
          $initial_psychi_121 ='checked="checked"';
        }
        if($data['initial_psychi_141']=='3' && $data['initial_psychi_141']!="")
        {
          $initial_psychi_141 ='checked="checked"';
        }

        if($data['initial_psychi_142']=='1' && $data['initial_psychi_142']!="")
        {
          $initial_psychi_142 ='checked="checked"';
        }
        if($data['initial_psychi_144']=='2' && $data['initial_psychi_144']!="")
        {
          $initial_psychi_144 ='checked="checked"';
        }
        if($data['initial_psychi_146']=='3' && $data['initial_psychi_146']!="")
        {
          $initial_psychi_146 ='checked="checked"';
        }
        if($data['initial_psychi_148']=='4' && $data['initial_psychi_148']!="")
        {
          $initial_psychi_148 ='checked="checked"';
        }
        if($data['initial_psychi_150']=='5' && $data['initial_psychi_150']!="")
        {
          $initial_psychi_150 ='checked="checked"';
        }
        if($data['initial_psychi_152']=='6' && $data['initial_psychi_152']!="")
        {
          $initial_psychi_152 ='checked="checked"';
        }

        if($data['initial_psychi_154']=='1' && $data['initial_psychi_154']!="")
        {
          $initial_psychi_154 ='checked="checked"';
        }

        if($data['initial_psychi_156']=='1' && $data['initial_psychi_156']!="")
        {
          $initial_psychi_156 ='checked="checked"';
        }

        if($data['initial_psychi_164']=='1' && $data['initial_psychi_164']!="")
        {
          $initial_psychi_164 ='checked="checked"';
        }
        if($data['initial_psychi_165']=='2' && $data['initial_psychi_165']!="")
        {
          $initial_psychi_165 ='checked="checked"';
        }
        if($data['initial_psychi_166']=='3' && $data['initial_psychi_166']!="")
        {
          $initial_psychi_166 ='checked="checked"';
        }
        if($data['initial_psychi_167']=='4' && $data['initial_psychi_167']!="")
        {
          $initial_psychi_167 ='checked="checked"';
        }

         if($data['initial_psychi_168']=='1' && $data['initial_psychi_168']!="")
        {
          $initial_psychi_168 ='checked="checked"';
        }

        if($data['initial_psychi_175']=='1' && $data['initial_psychi_175']!="")
        {
          $initial_psychi_175 ='checked="checked"';
        }

        if($data['initial_psychi_188']=='1' && $data['initial_psychi_188']!="")
        {
          $initial_psychi_188 ='checked="checked"';
        }

        if($data['initial_psychi_559']=='1' && $data['initial_psychi_559']!="")
        {
          $initial_psychi_559 ='checked="checked"';
        }

        if($data['initial_psychi_560']=='1' && $data['initial_psychi_560']!="")
        {
          $initial_psychi_560 ='checked="checked"';
        }

         if($data['initial_psychi_200']=='1' && $data['initial_psychi_200']!="")
        {
          $initial_psychi_200 ='checked="checked"';
        }
        if($data['initial_psychi_561']=='1' && $data['initial_psychi_561']!="")
        {
          $initial_psychi_561 ='checked="checked"';
        }
        if($data['initial_psychi_562']=='1' && $data['initial_psychi_562']!="")
        {
          $initial_psychi_562 ='checked="checked"';
        }
        if($data['initial_psychi_212']=='1' && $data['initial_psychi_212']!="")
        {
          $initial_psychi_212 ='checked="checked"';
        }
        if($data['initial_psychi_563']=='1' && $data['initial_psychi_563']!="")
        {
          $initial_psychi_563 ='checked="checked"';
        }
        if($data['initial_psychi_564']=='1' && $data['initial_psychi_564']!="")
        {
          $initial_psychi_564 ='checked="checked"';
        }
        if($data['initial_psychi_224']=='1' && $data['initial_psychi_224']!="")
        {
          $initial_psychi_224 ='checked="checked"';
        }
        if($data['initial_psychi_226']=='1' && $data['initial_psychi_226']!="")
        {
          $initial_psychi_226 ='checked="checked"';
        }
         if($data['initial_psychi_565']=='1' && $data['initial_psychi_565']!="")
        {
          $initial_psychi_565 ='checked="checked"';
        }
        if($data['initial_psychi_566']=='1' && $data['initial_psychi_566']!="")
        {
          $initial_psychi_566 ='checked="checked"';
        }
        if($data['initial_psychi_233']=='1' && $data['initial_psychi_233']!="")
        {
          $initial_psychi_233 ='checked="checked"';
        }
        if($data['initial_psychi_567']=='1' && $data['initial_psychi_567']!="")
        {
          $initial_psychi_567 ='checked="checked"';
        }
        if($data['initial_psychi_568']=='1' && $data['initial_psychi_568']!="")
        {
          $initial_psychi_568 ='checked="checked"';
        }
        if($data['initial_psychi_246']=='1' && $data['initial_psychi_246']!="")
        {
          $initial_psychi_246 ='checked="checked"';
        }
        if($data['initial_psychi_247']=='1' && $data['initial_psychi_247']!="")
        {
          $initial_psychi_247 ='checked="checked"';
        }
        if($data['initial_psychi_249']=='2' && $data['initial_psychi_249']!="")
        {
          $initial_psychi_249 ='checked="checked"';
        }
        if($data['initial_psychi_251']=='1' && $data['initial_psychi_251']!="")
        {
          $initial_psychi_251 ='checked="checked"';
        }
        if($data['initial_psychi_260']=='1' && $data['initial_psychi_260']!="")
        {
          $initial_psychi_260 ='checked="checked"';
        }
        if($data['initial_psychi_261']=='1' && $data['initial_psychi_261']!="")
        {
          $initial_psychi_261 ='checked="checked"';
        }
        if($data['initial_psychi_264']=='1' && $data['initial_psychi_264']!="")
        {
          $initial_psychi_264 ='checked="checked"';
        }

        if($data['initial_psychi_267']=='1' && $data['initial_psychi_267']!="")
        {
          $initial_psychi_267 ='checked="checked"';
        }
        if($data['initial_psychi_270']=='1' && $data['initial_psychi_270']!="")
        {
          $initial_psychi_270 ='checked="checked"';
        }
        if($data['initial_psychi_273']=='1' && $data['initial_psychi_273']!="")
        {
          $initial_psychi_273 ='checked="checked"';
        }
        if($data['initial_psychi_276']=='1' && $data['initial_psychi_276']!="")
        {
          $initial_psychi_276 ='checked="checked"';
        }
        if($data['initial_psychi_277']=='1' && $data['initial_psychi_277']!="")
        {
          $initial_psychi_277 ='checked="checked"';
        }

        if($data['initial_psychi_278']=='1' && $data['initial_psychi_278']!="")
        {
          $initial_psychi_278 ='checked="checked"';
        }
        if($data['initial_psychi_279']=='12' && $data['initial_psychi_279']!="")
        {
          $initial_psychi_279 ='checked="checked"';
        }
        if($data['initial_psychi_280']=='3' && $data['initial_psychi_280']!="")
        {
          $initial_psychi_280 ='checked="checked"';
        }
         if($data['initial_psychi_570']=='4' && $data['initial_psychi_570']!="")
        {
          $initial_psychi_570 ='checked="checked"';
        }
        if($data['initial_psychi_281']=='5' && $data['initial_psychi_281']!="")
        {
          $initial_psychi_281 ='checked="checked"';
        }
        if($data['initial_psychi_282']=='6' && $data['initial_psychi_282']!="")
        {
          $initial_psychi_282 ='checked="checked"';
        }

        if($data['initial_psychi_283']=='1' && $data['initial_psychi_283']!="")
        {
          $initial_psychi_283 ='checked="checked"';
        }

        if($data['initial_psychi_284']=='1' && $data['initial_psychi_284']!="")
        {
          $initial_psychi_284 ='checked="checked"';
        }
         if($data['initial_psychi_285']=='2' && $data['initial_psychi_285']!="")
        {
          $initial_psychi_285 ='checked="checked"';
        }
        if($data['initial_psychi_286']=='3' && $data['initial_psychi_286']!="")
        {
          $initial_psychi_286 ='checked="checked"';
        }
        if($data['initial_psychi_287']=='4' && $data['initial_psychi_287']!="")
        {
          $initial_psychi_287 ='checked="checked"';
        }

        if($data['initial_psychi_288']=='1' && $data['initial_psychi_288']!="")
        {
          $initial_psychi_288 ='checked="checked"';
        }
        if($data['initial_psychi_289']=='2' && $data['initial_psychi_289']!="")
        {
          $initial_psychi_289 ='checked="checked"';
        }
        if($data['initial_psychi_290']=='3' && $data['initial_psychi_290']!="")
        {
          $initial_psychi_290 ='checked="checked"';
        }
        if($data['initial_psychi_291']=='4' && $data['initial_psychi_291']!="")
        {
          $initial_psychi_291 ='checked="checked"';
        }
        if($data['initial_psychi_292']=='5' && $data['initial_psychi_292']!="")
        {
          $initial_psychi_292 ='checked="checked"';
        }
         if($data['initial_psychi_293']=='6' && $data['initial_psychi_293']!="")
        {
          $initial_psychi_293 ='checked="checked"';
        }
        if($data['initial_psychi_294']=='7' && $data['initial_psychi_294']!="")
        {
          $initial_psychi_294 ='checked="checked"';
        }
        if($data['initial_psychi_295']=='8' && $data['initial_psychi_295']!="")
        {
          $initial_psychi_295 ='checked="checked"';
        }
        if($data['initial_psychi_296']=='9' && $data['initial_psychi_296']!="")
        {
          $initial_psychi_296 ='checked="checked"';
        }
        if($data['initial_psychi_297']=='10' && $data['initial_psychi_297']!="")
        {
          $initial_psychi_297 ='checked="checked"';
        }
        if($data['initial_psychi_298']=='11' && $data['initial_psychi_298']!="")
        {
          $initial_psychi_298 ='checked="checked"';
        }
        if($data['initial_psychi_299']=='12' && $data['initial_psychi_299']!="")
        {
          $initial_psychi_299 ='checked="checked"';
        }
        if($data['initial_psychi_300']=='13' && $data['initial_psychi_300']!="")
        {
          $initial_psychi_300 ='checked="checked"';
        }
        if($data['initial_psychi_301']=='14' && $data['initial_psychi_301']!="")
        {
          $initial_psychi_301 ='checked="checked"';
        }
        if($data['initial_psychi_302']=='15' && $data['initial_psychi_302']!="")
        {
          $initial_psychi_302 ='checked="checked"';
        }

        if($data['initial_psychi_303']=='1' && $data['initial_psychi_303']!="")
        {
          $initial_psychi_303 ='checked="checked"';
        }

        if($data['initial_psychi_307']=='1' && $data['initial_psychi_307']!="")
        {
          $initial_psychi_307 ='checked="checked"';
        }
        if($data['initial_psychi_308']=='2' && $data['initial_psychi_308']!="")
        {
          $initial_psychi_308 ='checked="checked"';
        }
        if($data['initial_psychi_309']=='3' && $data['initial_psychi_309']!="")
        {
          $initial_psychi_309 ='checked="checked"';
        }

        if($data['initial_psychi_310']=='1' && $data['initial_psychi_310']!="")
        {
          $initial_psychi_310 ='checked="checked"';
        }
        if($data['initial_psychi_311']=='2' && $data['initial_psychi_311']!="")
        {
          $initial_psychi_311 ='checked="checked"';
        }
        if($data['initial_psychi_312']=='3' && $data['initial_psychi_312']!="")
        {
          $initial_psychi_312 ='checked="checked"';
        }
        if($data['initial_psychi_313']=='4' && $data['initial_psychi_313']!="")
        {
          $initial_psychi_313 ='checked="checked"';
        }

        if($data['initial_psychi_315']=='1' && $data['initial_psychi_315']!="")
        {
          $initial_psychi_315 ='checked="checked"';
        }
         if($data['initial_psychi_316']=='1' && $data['initial_psychi_316']!="")
        {
          $initial_psychi_316 ='checked="checked"';
        }

        if($data['initial_psychi_318']=='1' && $data['initial_psychi_318']!="")
        {
          $initial_psychi_318 ='checked="checked"';
        }
        if($data['initial_psychi_319']=='2' && $data['initial_psychi_319']!="")
        {
          $initial_psychi_319 ='checked="checked"';
        }
        if($data['initial_psychi_320']=='3' && $data['initial_psychi_320']!="")
        {
          $initial_psychi_320 ='checked="checked"';
        }

        if($data['initial_psychi_322']=='1' && $data['initial_psychi_322']!="")
        {
          $initial_psychi_322 ='checked="checked"';
        }
         if($data['initial_psychi_323']=='2' && $data['initial_psychi_323']!="")
        {
          $initial_psychi_323 ='checked="checked"';
        }
        if($data['initial_psychi_324']=='3' && $data['initial_psychi_324']!="")
        {
          $initial_psychi_324 ='checked="checked"';
        }
        if($data['initial_psychi_325']=='4' && $data['initial_psychi_325']!="")
        {
          $initial_psychi_325 ='checked="checked"';
        }

        if($data['initial_psychi_326']=='1' && $data['initial_psychi_326']!="")
        {
          $initial_psychi_326 ='checked="checked"';
        }
        if($data['initial_psychi_328']=='2' && $data['initial_psychi_328']!="")
        {
          $initial_psychi_328 ='checked="checked"';
        }

        if($data['initial_psychi_331']=='1' && $data['initial_psychi_331']!="")
        {
          $initial_psychi_331 ='checked="checked"';
        }
        if($data['initial_psychi_332']=='2' && $data['initial_psychi_332']!="")
        {
          $initial_psychi_332 ='checked="checked"';
        }
        if($data['initial_psychi_333']=='3' && $data['initial_psychi_333']!="")
        {
          $initial_psychi_333 ='checked="checked"';
        }
         if($data['initial_psychi_334']=='4' && $data['initial_psychi_334']!="")
        {
          $initial_psychi_334 ='checked="checked"';
        }

        if($data['initial_psychi_335']=='1' && $data['initial_psychi_335']!="")
        {
          $initial_psychi_335 ='checked="checked"';
        }
        if($data['initial_psychi_336']=='2' && $data['initial_psychi_336']!="")
        {
          $initial_psychi_336 ='checked="checked"';
        }
        if($data['initial_psychi_337']=='3' && $data['initial_psychi_337']!="")
        {
          $initial_psychi_337 ='checked="checked"';
        }

        if($data['initial_psychi_338']=='1' && $data['initial_psychi_338']!="")
        {
          $initial_psychi_338 ='checked="checked"';
        }
        if($data['initial_psychi_339']=='2' && $data['initial_psychi_339']!="")
        {
          $initial_psychi_339 ='checked="checked"';
        }

        if($data['initial_psychi_340']=='1' && $data['initial_psychi_340']!="")
        {
          $initial_psychi_340 ='checked="checked"';
        }
        if($data['initial_psychi_342']=='2' && $data['initial_psychi_342']!="")
        {
          $initial_psychi_342 ='checked="checked"';
        }

        if($data['initial_psychi_344']=='1' && $data['initial_psychi_344']!="")
        {
          $initial_psychi_344 ='checked="checked"';
        }
        if($data['initial_psychi_351']=='1' && $data['initial_psychi_351']!="")
        {
          $initial_psychi_351 ='checked="checked"';
        }

        if($data['initial_psychi_358']=='1' && $data['initial_psychi_358']!="")
        {
          $initial_psychi_358 ='checked="checked"';
        }
        if($data['initial_psychi_359']=='2' && $data['initial_psychi_359']!="")
        {
          $initial_psychi_359 ='checked="checked"';
        }
        if($data['initial_psychi_360']=='3' && $data['initial_psychi_360']!="")
        {
          $initial_psychi_360 ='checked="checked"';
        }
        if($data['initial_psychi_361']=='4' && $data['initial_psychi_361']!="")
        {
          $initial_psychi_361 ='checked="checked"';
        }
        if($data['initial_psychi_362']=='5' && $data['initial_psychi_362']!="")
        {
          $initial_psychi_362 ='checked="checked"';
        }
        if($data['initial_psychi_363']=='6' && $data['initial_psychi_363']!="")
        {
          $initial_psychi_363 ='checked="checked"';
        }
        if($data['initial_psychi_364']=='7' && $data['initial_psychi_364']!="")
        {
          $initial_psychi_364 ='checked="checked"';
        }
        if($data['initial_psychi_365']=='8' && $data['initial_psychi_365']!="")
        {
          $initial_psychi_365 ='checked="checked"';
        }
        if($data['initial_psychi_366']=='9' && $data['initial_psychi_366']!="")
        {
          $initial_psychi_366 ='checked="checked"';
        }

         if($data['initial_psychi_367']=='1' && $data['initial_psychi_367']!="")
        {
          $initial_psychi_367 ='checked="checked"';
        }
        if($data['initial_psychi_368']=='2' && $data['initial_psychi_368']!="")
        {
          $initial_psychi_368 ='checked="checked"';
        }
        if($data['initial_psychi_369']=='3' && $data['initial_psychi_369']!="")
        {
          $initial_psychi_369 ='checked="checked"';
        }

        if($data['initial_psychi_370']=='1' && $data['initial_psychi_370']!="")
        {
          $initial_psychi_370 ='checked="checked"';
        }
        if($data['initial_psychi_371']=='2' && $data['initial_psychi_371']!="")
        {
          $initial_psychi_371 ='checked="checked"';
        }

         if($data['initial_psychi_372']=='1' && $data['initial_psychi_372']!="")
        {
          $initial_psychi_372 ='checked="checked"';
        }
        if($data['initial_psychi_373']=='2' && $data['initial_psychi_373']!="")
        {
          $initial_psychi_373 ='checked="checked"';
        }

        if($data['initial_psychi_374']=='1' && $data['initial_psychi_374']!="")
        {
          $initial_psychi_374 ='checked="checked"';
        }
        if($data['initial_psychi_375']=='2' && $data['initial_psychi_375']!="")
        {
          $initial_psychi_375 ='checked="checked"';
        }

        if($data['initial_psychi_376']=='1' && $data['initial_psychi_376']!="")
        {
          $initial_psychi_376 ='checked="checked"';
        }
        if($data['initial_psychi_377']=='2' && $data['initial_psychi_377']!="")
        {
          $initial_psychi_377 ='checked="checked"';
        }
        if($data['initial_psychi_378']=='3' && $data['initial_psychi_378']!="")
        {
          $initial_psychi_378 ='checked="checked"';
        }
        if($data['initial_psychi_379']=='4' && $data['initial_psychi_379']!="")
        {
          $initial_psychi_379 ='checked="checked"';
        }
         if($data['initial_psychi_380']=='5' && $data['initial_psychi_380']!="")
        {
          $initial_psychi_380 ='checked="checked"';
        }
        if($data['initial_psychi_381']=='6' && $data['initial_psychi_381']!="")
        {
          $initial_psychi_381 ='checked="checked"';
        }

        if($data['initial_psychi_382']=='1' && $data['initial_psychi_382']!="")
        {
          $initial_psychi_382 ='checked="checked"';
        }

        if($data['initial_psychi_385']=='1' && $data['initial_psychi_385']!="")
        {
          $initial_psychi_385 ='checked="checked"';
        }
        if($data['initial_psychi_386']=='2' && $data['initial_psychi_386']!="")
        {
          $initial_psychi_386 ='checked="checked"';
        }
        if($data['initial_psychi_387']=='3' && $data['initial_psychi_387']!="")
        {
          $initial_psychi_387 ='checked="checked"';
        }

        if($data['initial_psychi_388']=='1' && $data['initial_psychi_388']!="")
        {
          $initial_psychi_388 ='checked="checked"';
        }
        if($data['initial_psychi_389']=='2' && $data['initial_psychi_389']!="")
        {
          $initial_psychi_389 ='checked="checked"';
        }
        if($data['initial_psychi_390']=='3' && $data['initial_psychi_390']!="")
        {
          $initial_psychi_390 ='checked="checked"';
        }
        if($data['initial_psychi_391']=='4' && $data['initial_psychi_391']!="")
        {
          $initial_psychi_391 ='checked="checked"';
        }
        if($data['initial_psychi_392']=='5' && $data['initial_psychi_392']!="")
        {
          $initial_psychi_392 ='checked="checked"';
        }
        if($data['initial_psychi_393']=='6' && $data['initial_psychi_393']!="")
        {
          $initial_psychi_393 ='checked="checked"';
        }
        if($data['initial_psychi_394']=='7' && $data['initial_psychi_394']!="")
        {
          $initial_psychi_394 ='checked="checked"';
        }
        if($data['initial_psychi_395']=='8' && $data['initial_psychi_395']!="")
        {
          $initial_psychi_395 ='checked="checked"';
        }
        if($data['initial_psychi_396']=='9' && $data['initial_psychi_396']!="")
        {
          $initial_psychi_396 ='checked="checked"';
        }
        if($data['initial_psychi_397']=='10' && $data['initial_psychi_397']!="")
        {
          $initial_psychi_397 ='checked="checked"';
        }
        if($data['initial_psychi_398']=='11' && $data['initial_psychi_398']!="")
        {
          $initial_psychi_398 ='checked="checked"';
        }
        if($data['initial_psychi_399']=='12' && $data['initial_psychi_399']!="")
        {
          $initial_psychi_399 ='checked="checked"';
        }
        if($data['initial_psychi_400']=='13' && $data['initial_psychi_400']!="")
        {
          $initial_psychi_400 ='checked="checked"';
        }
         if($data['initial_psychi_401']=='14' && $data['initial_psychi_401']!="")
        {
          $initial_psychi_401 ='checked="checked"';
        }
        if($data['initial_psychi_402']=='15' && $data['initial_psychi_402']!="")
        {
          $initial_psychi_402 ='checked="checked"';
        }
        if($data['initial_psychi_403']=='16' && $data['initial_psychi_403']!="")
        {
          $initial_psychi_403 ='checked="checked"';
        }
        if($data['initial_psychi_404']=='17' && $data['initial_psychi_404']!="")
        {
          $initial_psychi_404 ='checked="checked"';
        }
        if($data['initial_psychi_405']=='18' && $data['initial_psychi_405']!="")
        {
          $initial_psychi_405 ='checked="checked"';
        }
        if($data['initial_psychi_406']=='19' && $data['initial_psychi_406']!="")
        {
          $initial_psychi_406 ='checked="checked"';
        }
        if($data['initial_psychi_407']=='20' && $data['initial_psychi_407']!="")
        {
          $initial_psychi_407 ='checked="checked"';
        }

        if($data['initial_psychi_409']=='1' && $data['initial_psychi_409']!="")
        {
          $initial_psychi_409 ='checked="checked"';
        }
        if($data['initial_psychi_410']=='2' && $data['initial_psychi_410']!="")
        {
          $initial_psychi_410 ='checked="checked"';
        }
        if($data['initial_psychi_411']=='3' && $data['initial_psychi_411']!="")
        {
          $initial_psychi_411 ='checked="checked"';
        }

        if($data['initial_psychi_412']=='1' && $data['initial_psychi_412']!="")
        {
          $initial_psychi_412 ='checked="checked"';
        }
        if($data['initial_psychi_413']=='2' && $data['initial_psychi_413']!="")
        {
          $initial_psychi_413 ='checked="checked"';
        }
         if($data['initial_psychi_414']=='3' && $data['initial_psychi_414']!="")
        {
          $initial_psychi_414 ='checked="checked"';
        }

        if($data['initial_psychi_415']=='1' && $data['initial_psychi_415']!="")
        {
          $initial_psychi_415 ='checked="checked"';
        }
        if($data['initial_psychi_416']=='2' && $data['initial_psychi_416']!="")
        {
          $initial_psychi_416 ='checked="checked"';
        }
        if($data['initial_psychi_417']=='3' && $data['initial_psychi_417']!="")
        {
          $initial_psychi_417 ='checked="checked"';
        }
        if($data['initial_psychi_418']=='4' && $data['initial_psychi_418']!="")
        {
          $initial_psychi_418 ='checked="checked"';
        }

        if($data['initial_psychi_419']=='1' && $data['initial_psychi_419']!="")
        {
          $initial_psychi_419 ='checked="checked"';
        }
        if($data['initial_psychi_420']=='2' && $data['initial_psychi_420']!="")
        {
          $initial_psychi_420 ='checked="checked"';
        }
        if($data['initial_psychi_421']=='3' && $data['initial_psychi_421']!="")
        {
          $initial_psychi_421 ='checked="checked"';
        }
        if($data['initial_psychi_422']=='4' && $data['initial_psychi_422']!="")
        {
          $initial_psychi_422 ='checked="checked"';
        }

        if($data['initial_psychi_424']=='1' && $data['initial_psychi_424']!="")
        {
          $initial_psychi_424 ='checked="checked"';
        }
        if($data['initial_psychi_425']=='2' && $data['initial_psychi_425']!="")
        {
          $initial_psychi_425 ='checked="checked"';
        }
        if($data['initial_psychi_426']=='3' && $data['initial_psychi_426']!="")
        {
          $initial_psychi_426 ='checked="checked"';
        }
         if($data['initial_psychi_427']=='4' && $data['initial_psychi_427']!="")
        {
          $initial_psychi_427 ='checked="checked"';
        }

        if($data['initial_psychi_430']=='1' && $data['initial_psychi_430']!="")
        {
          $initial_psychi_430 ='checked="checked"';
        }
        if($data['initial_psychi_431']=='2' && $data['initial_psychi_431']!="")
        {
          $initial_psychi_431 ='checked="checked"';
        }
        if($data['initial_psychi_432']=='3' && $data['initial_psychi_432']!="")
        {
          $initial_psychi_432 ='checked="checked"';
        }

        if($data['initial_psychi_433']=='4' && $data['initial_psychi_433']!="")
        {
          $initial_psychi_433 ='checked="checked"';
        }
        if($data['initial_psychi_434']=='5' && $data['initial_psychi_434']!="")
        {
          $initial_psychi_434 ='checked="checked"';
        }
        if($data['initial_psychi_435']=='6' && $data['initial_psychi_435']!="")
        {
          $initial_psychi_435 ='checked="checked"';
        }

        if($data['initial_psychi_436']=='1' && $data['initial_psychi_436']!="")
        {
          $initial_psychi_436 ='checked="checked"';
        }
        if($data['initial_psychi_437']=='2' && $data['initial_psychi_437']!="")
        {
          $initial_psychi_437 ='checked="checked"';
        }
        if($data['initial_psychi_438']=='3' && $data['initial_psychi_438']!="")
        {
          $initial_psychi_438 ='checked="checked"';
        }
        if($data['initial_psychi_439']=='4' && $data['initial_psychi_439']!="")
        {
          $initial_psychi_439 ='checked="checked"';
        }
        if($data['initial_psychi_440']=='5' && $data['initial_psychi_440']!="")
        {
          $initial_psychi_440 ='checked="checked"';
        }
         if($data['initial_psychi_441']=='6' && $data['initial_psychi_441']!="")
        {
          $initial_psychi_441 ='checked="checked"';
        }
        if($data['initial_psychi_442']=='7' && $data['initial_psychi_442']!="")
        {
          $initial_psychi_442 ='checked="checked"';
        }
        if($data['initial_psychi_443']=='8' && $data['initial_psychi_443']!="")
        {
          $initial_psychi_443 ='checked="checked"';
        }
        if($data['initial_psychi_444']=='9' && $data['initial_psychi_444']!="")
        {
          $initial_psychi_444 ='checked="checked"';
        }
        if($data['initial_psychi_445']=='10' && $data['initial_psychi_445']!="")
        {
          $initial_psychi_445 ='checked="checked"';
        }

         if($data['initial_psychi_447']=='1' && $data['initial_psychi_447']!="")
        {
          $initial_psychi_447 ='checked="checked"';
        }if($data['initial_psychi_448']=='2' && $data['initial_psychi_448']!="")
        {
          $initial_psychi_448 ='checked="checked"';
        }
        if($data['initial_psychi_449']=='3' && $data['initial_psychi_449']!="")
        {
          $initial_psychi_449 ='checked="checked"';
        }
        if($data['initial_psychi_450']=='4' && $data['initial_psychi_450']!="")
        {
          $initial_psychi_450 ='checked="checked"';
        }
        if($data['initial_psychi_451']=='5' && $data['initial_psychi_451']!="")
        {
          $initial_psychi_451 ='checked="checked"';
        }
         if($data['initial_psychi_452']=='6' && $data['initial_psychi_452']!="")
        {
          $initial_psychi_452 ='checked="checked"';
        }if($data['initial_psychi_453']=='7' && $data['initial_psychi_453']!="")
        {
          $initial_psychi_453 ='checked="checked"';
        }

        if($data['initial_psychi_455']=='1' && $data['initial_psychi_455']!="")
        {
          $initial_psychi_455 ='checked="checked"';
        }
        if($data['initial_psychi_456']=='2' && $data['initial_psychi_456']!="")
        {
          $initial_psychi_456 ='checked="checked"';
        }
        if($data['initial_psychi_457']=='3' && $data['initial_psychi_457']!="")
        {
          $initial_psychi_457 ='checked="checked"';
        }

         if($data['initial_psychi_458']=='1' && $data['initial_psychi_458']!="")
        {
          $initial_psychi_458 ='checked="checked"';
        }if($data['initial_psychi_459']=='2' && $data['initial_psychi_459']!="")
        {
          $initial_psychi_459 ='checked="checked"';
        }
        if($data['initial_psychi_460']=='3' && $data['initial_psychi_460']!="")
        {
          $initial_psychi_460 ='checked="checked"';
        }
        if($data['initial_psychi_461']=='4' && $data['initial_psychi_461']!="")
        {
          $initial_psychi_461 ='checked="checked"';
        }

        if($data['initial_psychi_462']=='1' && $data['initial_psychi_462']!="")
        {
          $initial_psychi_462 ='checked="checked"';
        }
         if($data['initial_psychi_463']=='2' && $data['initial_psychi_463']!="")
        {
          $initial_psychi_463 ='checked="checked"';
        }

        if($data['initial_psychi_465']=='1' && $data['initial_psychi_465']!="")
        {
          $initial_psychi_465 ='checked="checked"';
        }
        if($data['initial_psychi_466']=='2' && $data['initial_psychi_466']!="")
        {
          $initial_psychi_466 ='checked="checked"';
        }
        if($data['initial_psychi_467']=='3' && $data['initial_psychi_467']!="")
        {
          $initial_psychi_467 ='checked="checked"';
        }
        if($data['initial_psychi_468']=='4' && $data['initial_psychi_468']!="")
        {
          $initial_psychi_468 ='checked="checked"';
        }
         if($data['initial_psychi_469']=='5' && $data['initial_psychi_469']!="")
        {
          $initial_psychi_469 ='checked="checked"';
        }if($data['initial_psychi_470']=='6' && $data['initial_psychi_470']!="")
        {
          $initial_psychi_470 ='checked="checked"';
        }
        if($data['initial_psychi_471']=='7' && $data['initial_psychi_471']!="")
        {
          $initial_psychi_471 ='checked="checked"';
        }
        if($data['initial_psychi_472']=='8' && $data['initial_psychi_472']!="")
        {
          $initial_psychi_472 ='checked="checked"';
        }
        if($data['initial_psychi_473']=='9' && $data['initial_psychi_473']!="")
        {
          $initial_psychi_473 ='checked="checked"';
        }

         if($data['initial_psychi_475']=='1' && $data['initial_psychi_475']!="")
        {
          $initial_psychi_475 ='checked="checked"';
        }if($data['initial_psychi_476']=='2' && $data['initial_psychi_476']!="")
        {
          $initial_psychi_476 ='checked="checked"';
        }
        if($data['initial_psychi_478']=='3' && $data['initial_psychi_478']!="")
        {
          $initial_psychi_478 ='checked="checked"';
        }
        if($data['initial_psychi_479']=='4' && $data['initial_psychi_479']!="")
        {
          $initial_psychi_479 ='checked="checked"';
        }

        if($data['initial_psychi_481']=='1' && $data['initial_psychi_481']!="")
        {
          $initial_psychi_481 ='checked="checked"';
        }
         if($data['initial_psychi_482']=='2' && $data['initial_psychi_482']!="")
        {
          $initial_psychi_482 ='checked="checked"';
        }if($data['initial_psychi_483']=='3' && $data['initial_psychi_483']!="")
        {
          $initial_psychi_483 ='checked="checked"';
        }
        if($data['initial_psychi_484']=='4' && $data['initial_psychi_484']!="")
        {
          $initial_psychi_484 ='checked="checked"';
        }
        if($data['initial_psychi_485']=='5' && $data['initial_psychi_485']!="")
        {
          $initial_psychi_485 ='checked="checked"';
        }
        if($data['initial_psychi_486']=='6' && $data['initial_psychi_486']!="")
        {
          $initial_psychi_486 ='checked="checked"';
        }
         if($data['initial_psychi_487']=='7' && $data['initial_psychi_487']!="")
        {
          $initial_psychi_487 ='checked="checked"';
        }if($data['initial_psychi_488']=='8' && $data['initial_psychi_488']!="")
        {
          $initial_psychi_488 ='checked="checked"';
        }

        if($data['initial_psychi_490']=='1' && $data['initial_psychi_490']!="")
        {
          $initial_psychi_490 ='checked="checked"';
        }
        if($data['initial_psychi_491']=='2' && $data['initial_psychi_491']!="")
        {
          $initial_psychi_491 ='checked="checked"';
        }
        if($data['initial_psychi_492']=='3' && $data['initial_psychi_492']!="")
        {
          $initial_psychi_492 ='checked="checked"';
        }
         if($data['initial_psychi_493']=='4' && $data['initial_psychi_493']!="")
        {
          $initial_psychi_493 ='checked="checked"';
        }
        if($data['initial_psychi_494']=='5' && $data['initial_psychi_494']!="")
        {
          $initial_psychi_494 ='checked="checked"';
        }
        if($data['initial_psychi_495']=='6' && $data['initial_psychi_495']!="")
        {
          $initial_psychi_495 ='checked="checked"';
        }
        if($data['initial_psychi_496']=='7' && $data['initial_psychi_496']!="")
        {
          $initial_psychi_496 ='checked="checked"';
        }

        if($data['initial_psychi_498']=='1' && $data['initial_psychi_498']!="")
        {
          $initial_psychi_498 ='checked="checked"';
        }
        if($data['initial_psychi_499']=='2' && $data['initial_psychi_499']!="")
        {
          $initial_psychi_499 ='checked="checked"';
        }
         if($data['initial_psychi_500']=='3' && $data['initial_psychi_500']!="")
        {
          $initial_psychi_500 ='checked="checked"';
        }
        if($data['initial_psychi_501']=='4' && $data['initial_psychi_501']!="")
        {
          $initial_psychi_501 ='checked="checked"';
        }
        if($data['initial_psychi_502']=='5' && $data['initial_psychi_502']!="")
        {
          $initial_psychi_502 ='checked="checked"';
        }

        if($data['initial_psychi_504']=='1' && $data['initial_psychi_504']!="")
        {
          $initial_psychi_504 ='checked="checked"';
        }
        if($data['initial_psychi_505']=='2' && $data['initial_psychi_505']!="")
        {
          $initial_psychi_505 ='checked="checked"';
        }
         if($data['initial_psychi_506']=='3' && $data['initial_psychi_506']!="")
        {
          $initial_psychi_506 ='checked="checked"';
        }
        if($data['initial_psychi_507']=='4' && $data['initial_psychi_507']!="")
        {
          $initial_psychi_507 ='checked="checked"';
        }
        if($data['initial_psychi_508']=='5' && $data['initial_psychi_508']!="")
        {
          $initial_psychi_508 ='checked="checked"';
        }
        if($data['initial_psychi_509']=='6' && $data['initial_psychi_509']!="")
        {
          $initial_psychi_509 ='checked="checked"';
        }

        if($data['initial_psychi_511']=='1' && $data['initial_psychi_511']!="")
        {
          $initial_psychi_511 ='checked="checked"';
        }
        if($data['initial_psychi_512']=='2' && $data['initial_psychi_512']!="")
        {
          $initial_psychi_512 ='checked="checked"';
        }
        if($data['initial_psychi_513']=='3' && $data['initial_psychi_513']!="")
        {
          $initial_psychi_513 ='checked="checked"';
        }
         if($data['initial_psychi_514']=='4' && $data['initial_psychi_514']!="")
        {
          $initial_psychi_514 ='checked="checked"';
        }
        if($data['initial_psychi_515']=='5' && $data['initial_psychi_515']!="")
        {
          $initial_psychi_515 ='checked="checked"';
        }

        if($data['initial_psychi_517']=='1' && $data['initial_psychi_517']!="")
        {
          $initial_psychi_517 ='checked="checked"';
        }
        if($data['initial_psychi_518']=='2' && $data['initial_psychi_518']!="")
        {
          $initial_psychi_518 ='checked="checked"';
        }
        if($data['initial_psychi_519']=='3' && $data['initial_psychi_519']!="")
        {
          $initial_psychi_519 ='checked="checked"';
        }
         if($data['initial_psychi_520']=='4' && $data['initial_psychi_520']!="")
        {
          $initial_psychi_520 ='checked="checked"';
        }
        if($data['initial_psychi_521']=='5' && $data['initial_psychi_521']!="")
        {
          $initial_psychi_521 ='checked="checked"';
        }

        if($data['initial_psychi_522']=='1' && $data['initial_psychi_522']!="")
        {
          $initial_psychi_522 ='checked="checked"';
        }
        if($data['initial_psychi_523']=='2' && $data['initial_psychi_523']!="")
        {
          $initial_psychi_523 ='checked="checked"';
        }
        if($data['initial_psychi_524']=='3' && $data['initial_psychi_524']!="")
        {
          $initial_psychi_524 ='checked="checked"';
        }
         if($data['initial_psychi_525']=='4' && $data['initial_psychi_525']!="")
        {
          $initial_psychi_525 ='checked="checked"';
        }
        if($data['initial_psychi_526']=='5' && $data['initial_psychi_526']!="")
        {
          $initial_psychi_526 ='checked="checked"';
        }

        if($data['initial_psychi_527']=='1' && $data['initial_psychi_527']!="")
        {
          $initial_psychi_527 ='checked="checked"';
        }
        if($data['initial_psychi_528']=='2' && $data['initial_psychi_528']!="")
        {
          $initial_psychi_528 ='checked="checked"';
        }
        if($data['initial_psychi_529']=='3' && $data['initial_psychi_529']!="")
        {
          $initial_psychi_529 ='checked="checked"';
        }

         if($data['initial_psychi_531']=='1' && $data['initial_psychi_531']!="")
        {
          $initial_psychi_531 ='checked="checked"';
        }
        if($data['initial_psychi_532']=='2' && $data['initial_psychi_532']!="")
        {
          $initial_psychi_532 ='checked="checked"';
        }
        if($data['initial_psychi_533']=='3' && $data['initial_psychi_533']!="")
        {
          $initial_psychi_533 ='checked="checked"';
        }
        if($data['initial_psychi_534']=='4' && $data['initial_psychi_534']!="")
        {
          $initial_psychi_534 ='checked="checked"';
        }

        if($data['initial_psychi_536']=='1' && $data['initial_psychi_536']!="")
        {
          $initial_psychi_536 ='checked="checked"';
        }
         if($data['initial_psychi_537']=='2' && $data['initial_psychi_537']!="")
        {
          $initial_psychi_537 ='checked="checked"';
        }
        if($data['initial_psychi_538']=='3' && $data['initial_psychi_538']!="")
        {
          $initial_psychi_538 ='checked="checked"';
        }
        if($data['initial_psychi_539']=='4' && $data['initial_psychi_539']!="")
        {
          $initial_psychi_539 ='checked="checked"';
        }

        if($data['initial_psychi_541']=='1' && $data['initial_psychi_541']!="")
        {
          $initial_psychi_541 ='checked="checked"';
        }
        if($data['initial_psychi_542']=='2' && $data['initial_psychi_542']!="")
        {
          $initial_psychi_542 ='checked="checked"';
        }
         if($data['initial_psychi_543']=='3' && $data['initial_psychi_543']!="")
        {
          $initial_psychi_543 ='checked="checked"';
        }
        if($data['initial_psychi_544']=='4' && $data['initial_psychi_544']!="")
        {
          $initial_psychi_544 ='checked="checked"';
        }

        if($data['initial_psychi_546']=='1' && $data['initial_psychi_546']!="")
        {
          $initial_psychi_546 ='checked="checked"';
        }
        if($data['initial_psychi_547']=='2' && $data['initial_psychi_547']!="")
        {
          $initial_psychi_547 ='checked="checked"';
        }
        if($data['initial_psychi_548']=='3' && $data['initial_psychi_548']!="")
        {
          $initial_psychi_548 ='checked="checked"';
        }
         if($data['initial_psychi_549']=='4' && $data['initial_psychi_549']!="")
        {
          $initial_psychi_549 ='checked="checked"';
        }

        if($data['initial_psychi_552']=='1' && $data['initial_psychi_552']!="")
        {
          $initial_psychi_552 ='checked="checked"';
        }
        if($data['initial_psychi_553']=='2' && $data['initial_psychi_553']!="")
        {
          $initial_psychi_553 ='checked="checked"';
        }
        if($data['initial_psychi_554']=='3' && $data['initial_psychi_554']!="")
        {
          $initial_psychi_554 ='checked="checked"';
        }

        if($data['initial_psychi_571']=='1' && $data['initial_psychi_571']!="")
        {
          $initial_psychi_571 ='checked="checked"';
        }
        if($data['initial_psychi_572']=='2' && $data['initial_psychi_572']!="")
        {
          $initial_psychi_572 ='checked="checked"';
        }
        if($data['initial_psychi_573']=='3' && $data['initial_psychi_573']!="")
        {
          $initial_psychi_573 ='checked="checked"';
        }
        if($data['initial_psychi_574']=='4' && $data['initial_psychi_574']!="")
        {
          $initial_psychi_574 ='checked="checked"';
        }
        if($data['initial_psychi_575']=='5' && $data['initial_psychi_575']!="")
        {
          $initial_psychi_575 ='checked="checked"';
        }
        if($data['initial_psychi_576']=='6' && $data['initial_psychi_576']!="")
        {
          $initial_psychi_576 ='checked="checked"';
        }
        if($data['initial_psychi_577']=='7' && $data['initial_psychi_577']!="")
        {
          $initial_psychi_577 ='checked="checked"';
        }
        if($data['initial_psychi_578']=='8' && $data['initial_psychi_578']!="")
        {
          $initial_psychi_578 ='checked="checked"';
        }
        if($data['initial_psychi_579']=='9' && $data['initial_psychi_579']!="")
        {
          $initial_psychi_579 ='checked="checked"';
        }
        if($data['initial_psychi_580']=='10' && $data['initial_psychi_580']!="")
        {
          $initial_psychi_580 ='checked="checked"';
        }
        if($data['initial_psychi_581']=='11' && $data['initial_psychi_581']!="")
        {
          $initial_psychi_581 ='checked="checked"';
        }
        if($data['initial_psychi_582']=='12' && $data['initial_psychi_582']!="")
        {
          $initial_psychi_582 ='checked="checked"';
        }
        if($data['initial_psychi_583']=='13' && $data['initial_psychi_583']!="")
        {
          $initial_psychi_583 ='checked="checked"';
        }
        if($data['initial_psychi_584']=='14' && $data['initial_psychi_584']!="")
        {
          $initial_psychi_584 ='checked="checked"';
        }
        if($data['initial_psychi_585']=='15' && $data['initial_psychi_585']!="")
        {
          $initial_psychi_585 ='checked="checked"';
        }
        if($data['initial_psychi_586']=='15' && $data['initial_psychi_586']!="")
        {
          $initial_psychi_586 ='checked="checked"';
        }
        if($data['initial_psychi_587']=='17' && $data['initial_psychi_587']!="")
        {
          $initial_psychi_587 ='checked="checked"';
        }
        if($data['initial_psychi_588']=='18' && $data['initial_psychi_588']!="")
        {
          $initial_psychi_588 ='checked="checked"';
        }
        if($data['initial_psychi_589']=='19' && $data['initial_psychi_589']!="")
        {
          $initial_psychi_589 ='checked="checked"';
        }
        if($data['initial_psychi_590']=='20' && $data['initial_psychi_590']!="")
        {
          $initial_psychi_590 ='checked="checked"';
        }
        if($data['initial_psychi_591']=='21' && $data['initial_psychi_591']!="")
        {
          $initial_psychi_591 ='checked="checked"';
        }
        if($data['initial_psychi_592']=='22' && $data['initial_psychi_592']!="")
        {
          $initial_psychi_592 ='checked="checked"';
        }
        if($data['initial_psychi_593']=='23' && $data['initial_psychi_593']!="")
        {
          $initial_psychi_593 ='checked="checked"';
        }
        if($data['initial_psychi_594']=='24' && $data['initial_psychi_594']!="")
        {
          $initial_psychi_594 ='checked="checked"';
        }
        if($data['initial_psychi_595']=='25' && $data['initial_psychi_595']!="")
        {
          $initial_psychi_595 ='checked="checked"';
        }
        if($data['initial_psychi_596']=='26' && $data['initial_psychi_596']!="")
        {
          $initial_psychi_596 ='checked="checked"';
        }
        if($data['initial_psychi_597']=='27' && $data['initial_psychi_597']!="")
        {
          $initial_psychi_597 ='checked="checked"';
        }
        if($data['initial_psychi_598']=='28' && $data['initial_psychi_598']!="")
        {
          $initial_psychi_598 ='checked="checked"';
        }

        $print = '
        <table style="width:100%;">
         <tr>
          <td><h4 style="width:100%; text-align:center;">Initial Psychiatric Evaluation</h4></td>
         </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td>Patient Name: '.$data['initial_psychi_1'].'</td>
            <td>DOB: '.$data['initial_psychi_2'].'</td>
            <td>Evaluation Date: '.$data['initial_psychi_3'].'</td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td>Allergies: '.$data['initial_psychi_4'].'</td>
          </tr>
          <tr>
            <td>Address: '.$data['initial_psychi_5'].'</td>
          </tr>
          <tr>
            <td>Referral Source: '.$data['initial_psychi_6'].'</td>
          </tr>
          <tr>
            <td>Sources of Information: <input type="checkbox" name="referral" value="1" '.$initial_psychi_7.'> interviews, with: <input type="checkbox" name="referral" value="2" '.$initial_psychi_8.'>medical records <input type="checkbox" name="referral" value="3" '.$initial_psychi_9.'>test results <input type="checkbox" name="referral" value="4" '.$initial_psychi_10.'>school records</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="referral" value="1" '.$initial_psychi_11.'> Other: Self <input type="checkbox" name="referral" value="2" '.$initial_psychi_12.'>If accompanied by family member: N/A</td>
          </tr>
        </table>
        <br>
        <table style="width:100%;">
          <tr>
            <td style="width:60%;">Reason for Referral: (LOC)'.$data['initial_psychi_13'].'</td>
            <td style="width:20%;">for '.$data['initial_psychi_14'].'</td>
            <td style="width:20%;">Use Disorder</td>
          </tr>
          <tr>
            <td>Chief Complaint: “∆ Quote for New LOC”</td>
          </tr>
        </table>
        <table>
          <tr>
            <td>General Patient Information</td>
          </tr>
          <tr>
            <td><br> Are you single/married? : '.$data['initial_psychi_15'].'</td>
          </tr>
          <tr>
            <td> Are you employed at this time? : '.$data['initial_psychi_16'].'</td>
          </tr>
          <tr>
            <td> Who do you live with currently? : '.$data['initial_psychi_17'].'</td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Biomedical</td>
          </tr>
          <tr>
            <td><br> Medical Problems at this time? : '.$data['initial_psychi_18'].'</td>
          </tr>
          <tr>
            <td> Hx of hospitalization : '.$data['initial_psychi_19'].'</td>
          </tr>
          <tr>
            <td> Current medications : '.$data['initial_psychi_20'].'</td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Psychiatric</td>
          </tr>
          <tr>
            <td><br> Mental Health Diagnoses : '.$data['initial_psychi_21'].'</td>
          </tr>
          <tr>
            <td> Psychiatric Medications : '.$data['initial_psychi_22'].'</td>
          </tr>
          <tr>
            <td> Any history of depression: '.$data['initial_psychi_23'].'</td>
          </tr>
          <tr>
            <td> Hx of Self-Mutilation, SI/HI: '.$data['initial_psychi_24'].'</td>
          </tr>
          <tr>
            <td> Hx of eating disorders: '.$data['initial_psychi_25'].'</td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Substance Use History</td>
          </tr>
          <tr>
            <td><br> Age of first use: '.$data['initial_psychi_26'].'</td>
          </tr>
          <tr>
            <td> Frequency: '.$data['initial_psychi_27'].'</td>
          </tr>
          <tr>
            <td> Quantity: '.$data['initial_psychi_28'].'</td>
          </tr>
          <tr>
            <td> Reason for use: '.$data['initial_psychi_29'].'</td>
          </tr>
          <tr>
            <td> Dates of escalation/sobriety: '.$data['initial_psychi_30'].'</td>
          </tr>
          <tr>
            <td> Date of last use***: '.$data['initial_psychi_31'].'</td>
          </tr>
          <tr>
            <td> Previous treatment episodes: '.$data['initial_psychi_32'].'</td>
          </tr>
          <tr>
            <td> Any overdoses?: '.$data['initial_psychi_33'].'</td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Other</td>
          </tr>
          <tr>
            <td><br> Current Stressors: '.$data['initial_psychi_34'].'</td>
          </tr>
          <tr>
            <td> Access to Firearms: Yes/No '.$data['initial_psychi_35'].'</td>
          </tr>
          <tr>
            <td> Who will be you collateral contact?: '.$data['initial_psychi_36'].'</td>
          </tr>
          <tr>
            <td> ';
            if(isset($data['text1'])){
              $print.= $data['text1']; 
            } else{
                
               $print.=' History of Present Illness: Patient is a {age} , {marital status}, {employment status} {race} {gender}
                who presents to the Center for Network Therapy for {Level of Care} for'; } 
                $print.=$data['initial_psychi_37'];
                if(isset($data['text2'])){
                 $print.= $data['text2']; 
               } else{
                   
                  $print.=' Use Disorder.
                Patient was educated that in the event of non-compliance or inability to maintain treatment plan
                objectives, she would be referred to a higher level of care which includes the following: Seabrook
                House, Carrier Clinic, Summit Oaks Hospital, and Princeton House Behavioral Health. She verbalized
                her understanding. Patient signed a release of information for her {insert collateral contact}. She
                was educated that he will be contacted for collateral information, missed appointments and
                discharge recommendations. She currently lives {insert living arrangement}. She presents with'; } 
                $print.=$data['initial_psychi_38'];
                if(isset($data['text3'])){
                  $print.= $data['text3']; 
                } else{
                    
                   $print.=' Use Disorder as evidenced by her history of {daily/regular} '.$data['initial_psychi_39'];
                   } 
                   $print.=' use.</td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Insert Substance Use Description <td>
          </tr>
          <tr>
            <td> The patient began using  '.$data['initial_psychi_40'].'</td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Insert Biomedical Information</td>
          </tr>
          <tr>
            <td> Medically the patient reports Patient will be monitored throughout the course of treatment.</td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Insert Psychiatric Information</td>
          </tr>
          <tr>
            <td>Psychiatrically, the patient reports Patient specified not having any self-mutilating behaviors.
                Patient does not currently present with any SI/HI/VH/AH at this time.</td>
          </tr>
        </table>
        <br>
        <table>
          <tr>
            <td>Other</td>
          </tr>
          <tr>
            <td>';
            if(isset($data['text4'])){
              $print.= $data['text4']; 
            } else{
                
               $print.='Patient’s current stressors are She reports not having access to firearms. The patient
                clearly understands instructions for care and has been able to follow instructions and has an
                adequate understanding of the {Level of Care} Program and has expressed commitment to continue
                at this level of care. Patient was educated about the risk of relapse, potential overdose and possible
                death. She understood the risks versus benefits, drug-drug interactions, polysubstance use and
                abuse. She was educated about if in need to rush to the nearest ER and or call 911 after hours.'; } 
                $print.='</td>
          </tr>
        </table>
        <br>
        <table style="width:100%">
          <tr>
            <td><input type="checkbox" name="initial_psychi_41" value="1" '.$initial_psychi_41.'> Bipolar: Manic or Hypomanic (3 or more)</td>
            <td><input type="checkbox" name="initial_psychi_42" value="2" '.$initial_psychi_42.'> Depression (5 or more)</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_43" value="3" '.$initial_psychi_43.'> expansive/ irritable mood</td>
            <td><input type="checkbox" name="initial_psychi_44" value="4" '.$initial_psychi_44.'> depressed mood (specify frequency)</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_45" value="5" '.$initial_psychi_45.'> inflated self-esteem or grandiosity</td>
            <td><input type="checkbox" name="initial_psychi_46" value="6" '.$initial_psychi_46.'> diminished interests in activities</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_47" value="7" '.$initial_psychi_47.'> decreased need for sleep</td>
            <td><input type="checkbox" name="initial_psychi_48" value="8" '.$initial_psychi_48.'> increase or decrease in appetite</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_49" value="9" '.$initial_psychi_49.'> flight of ideas or subjective experience of racing thoughts</td>
            <td><input type="checkbox" name="initial_psychi_50" value="10" '.$initial_psychi_50.'> psychomotor retardation</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_51" value="11" '.$initial_psychi_51.'> distractibility as reported or observed</td>
            <td><input type="checkbox" name="initial_psychi_52" value="12" '.$initial_psychi_52.'> psychomotor agitation</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_53" value="13" '.$initial_psychi_53.'> increased goal directed activity</td>
            <td><input type="checkbox" name="initial_psychi_54" value="14" '.$initial_psychi_54.'> fatigue or loss of energy</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_56" value="15" '.$initial_psychi_56.'> psychomotor agitation</td>
            <td><input type="checkbox" name="initial_psychi_57" value="16" '.$initial_psychi_57.'> insomnia or hypersomnia</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_58" value="17" '.$initial_psychi_58.'> rage</td>
            <td><input type="checkbox" name="initial_psychi_59" value="18" '.$initial_psychi_59.'> low self-esteem</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_60" value="19" '.$initial_psychi_60.'> excessive involvement in activities with high potential or painful consequences</td>
            <td><input type="checkbox" name="initial_psychi_61" value="20" '.$initial_psychi_61.'> hopelessness</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_62" value="21" '.$initial_psychi_62.'> interrupting/ intruding others</td>
            <td><input type="checkbox" name="initial_psychi_63" value="22" '.$initial_psychi_63.'> feelings of worthlessness or excessive or inappropriate guilt</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_64" value="23" '.$initial_psychi_64.'> independent of mood disturbance</td>
            <td><input type="checkbox" name="initial_psychi_65" value="24" '.$initial_psychi_65.'> recurrent thoughts of death or suicidal ideation</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_66" value="25" '.$initial_psychi_66.'> suicidal thoughts:</td>
            <td><input type="checkbox" name="initial_psychi_67" value="26" '.$initial_psychi_67.'> diminished ability to think or concentrate, indecisiveness either subjective or objective</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_68" value="27" '.$initial_psychi_68.'> homicidal thoughts:</td>
            <td><input type="checkbox" name="initial_psychi_69" value="28" '.$initial_psychi_69.'> substance/medication induced depression</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_70" value="29" '.$initial_psychi_70.'> obsessions</td>
          </tr>
          <tr>
            <td><input type="checkbox" name="initial_psychi_71" value="30" '.$initial_psychi_71.'> compulsions</td>
          </tr>
        </table>
        <br>
        <table style="width:100%">
          <tr>
            <td style="border: 1px solid black">
                ADHD: Hyperactivity/
                Impulsivity (6 or more)
                fidgety/ squirming in seat
                leaves seat in classroom or office
                fails close attention
                runs about/climbs in
                inappropriate situations
                difficulty playing quietly
                “on the go”
                talking excessively
                blurting answers
                difficulty awaiting turn
              </td>

            <td style="border: 1px solid black">
                Conduct Disorder (3 or more)
                aggression to people/ animals
                bullying/ threatening/ intimidating/
                initiating fights
                used weapon causing harm
                physically cruel to people/ animals
                stealing with confrontation
                forced into sexual activity
            </td>
            <td style="border: 1px solid black">
              ADHD: Inattention (6
              or more)
              inattention
              difficulty sustaining attention
              difficulty listening
              difficulty following
              instructions
              difficulty finishing tasks
              poor time management
              difficulty organizing
              losing things often
              easily distracted
              forgetful
            </td>
          </tr>
          <tr>
            <td style="border: 1px solid black">
              <input type="checkbox" name="initial_psychi_72" value="" '.$initial_psychi_72.'> Deceitful/ Theft
              <input type="checkbox" name="initial_psychi_73" value="" '.$initial_psychi_73.'> breaking in
              <input type="checkbox" name="initial_psychi_74" value="" '.$initial_psychi_74.'> lying
              <input type="checkbox" name="initial_psychi_75" value="" '.$initial_psychi_75.'> stealing
              <input type="checkbox" name="initial_psychi_76" value="" '.$initial_psychi_76.'> serious violation(s)
              <input type="checkbox" name="initial_psychi_77" value="" '.$initial_psychi_77.'> staying out late
              <input type="checkbox" name="initial_psychi_78" value="" '.$initial_psychi_78.'> running away (minimum 2x)
            </td>
            <td style="border: 1px solid black">
              <input type="checkbox" name="initial_psychi_79" value="" '.$initial_psychi_79.'>ODD (4 or more)
              <input type="checkbox" name="initial_psychi_80" value="" '.$initial_psychi_80.'>losing temper
              <input type="checkbox" name="initial_psychi_81" value="" '.$initial_psychi_81.'>arguing with adults
              <input type="checkbox" name="initial_psychi_82" value="" '.$initial_psychi_82.'>defiant/ refusal to comply
              <input type="checkbox" name="initial_psychi_83" value="" '.$initial_psychi_83.'>deliberately annoying people
              <input type="checkbox" name="initial_psychi_84" value="" '.$initial_psychi_84.'>blaming others for mistakes
              <input type="checkbox" name="initial_psychi_85" value="" '.$initial_psychi_85.'>touchy/ easily annoyed
              <input type="checkbox" name="initial_psychi_86" value="" '.$initial_psychi_86.'>angry
              <input type="checkbox" name="initial_psychi_87" value="" '.$initial_psychi_87.'>resentful
            </td>
            <td style="border: 1px solid black">
            <input type="checkbox" name="initial_psychi_88" value="" '.$initial_psychi_88.'>Autism (6 or more)
            <input type="checkbox" name="initial_psychi_89" value="" '.$initial_psychi_89.'>Social interaction
            <input type="checkbox" name="initial_psychi_90" value="" '.$initial_psychi_90.'>impairment to multiple nonverbal
            <input type="checkbox" name="initial_psychi_91" value="" '.$initial_psychi_91.'>lack of age appropriate relationships
            <input type="checkbox" name="initial_psychi_92" value="" '.$initial_psychi_92.'>lack of spontaneity
            <input type="checkbox" name="initial_psychi_93" value="" '.$initial_psychi_93.'>seeking to share joy
            <input type="checkbox" name="initial_psychi_94" value="" '.$initial_psychi_94.'>lack of emotional reciprocity
            <input type="checkbox" name="initial_psychi_95" value="" '.$initial_psychi_95.'>truant before 13
            </td>
          </tr>
          <tr>
            <td style="border: 1px solid black">
              <input type="checkbox" name="initial_psychi_96" value="" '.$initial_psychi_96.'>Communication
              <input type="checkbox" name="initial_psychi_97" value="" '.$initial_psychi_97.'>delay in speech preoccupation
              <input type="checkbox" name="initial_psychi_98" value="" '.$initial_psychi_98.'>impaired initiation of conversation
              <input type="checkbox" name="initial_psychi_99" value="" '.$initial_psychi_99.'>stereotype language
              <input type="checkbox" name="initial_psychi_100" value="" '.$initial_psychi_100.'>lack of make believe play
              <input type="checkbox" name="initial_psychi_101" value="" '.$initial_psychi_101.'>spiteful/vindictive
            </td>
            <td style="border: 1px solid black">
              <input type="checkbox" name="initial_psychi_102" value="" '.$initial_psychi_102.'>Destruction to property
              <input type="checkbox" name="initial_psychi_103" value="" '.$initial_psychi_103.'>deliberate fire setting with harm
              <input type="checkbox" name="initial_psychi_104" value="" '.$initial_psychi_104.'>deliberate property destruction
            </td>
            <td style="border: 1px solid black">
              <input type="checkbox" name="initial_psychi_105" value="" '.$initial_psychi_105.'>Anxiety
              <input type="checkbox" name="initial_psychi_106" value="" '.$initial_psychi_106.'>finds it difficult to control worry
              <input type="checkbox" name="initial_psychi_107" value="" '.$initial_psychi_107.'>restlessness or feeling keyed up or on edge
              <input type="checkbox" name="initial_psychi_108" value="" '.$initial_psychi_108.'>being easily fatigued
              <input type="checkbox" name="initial_psychi_109" value="" '.$initial_psychi_109.'>difficulty concentrating or mind going blank
              <input type="checkbox" name="initial_psychi_110" value="" '.$initial_psychi_110.'>irritability
              <input type="checkbox" name="initial_psychi_111" value="" '.$initial_psychi_111.'>muscle tension
              <input type="checkbox" name="initial_psychi_112" value="" '.$initial_psychi_112.'>sleep disturbance
              <input type="checkbox" name="initial_psychi_113" value="" '.$initial_psychi_113.'>panic disorder
              <input type="checkbox" name="initial_psychi_114" value="" '.$initial_psychi_114.'>specific phobia
              <input type="checkbox" name="initial_psychi_115" value="" '.$initial_psychi_115.'>social anxiety disorder
              <input type="checkbox" name="initial_psychi_116" value="" '.$initial_psychi_116.'>agoraphobia
              <input type="checkbox" name="initial_psychi_117" value="" '.$initial_psychi_117.'>substance/medication induced anxiety
            </td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black">Primary Care: '.$data['initial_psychi_118'].'</td>
            <td style="width:50%; border: 1px solid black">Phone: '.$data['initial_psychi_119'].'</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black">Address: '.$data['initial_psychi_120'].'</td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black">MD: '.$data['initial_psychi_121'].'</td>
            <td style="width:50%; border: 1px solid black">Phone: '.$data['initial_psychi_122'].'</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black">Address: '.$data['initial_psychi_123'].'</td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black">Therapist: '.$data['initial_psychi_124'].'</td>
            <td style="width:50%; border: 1px solid black">Phone: '.$data['initial_psychi_125'].'</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black">Address: '.$data['initial_psychi_126'].'</td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black">Other: '.$data['initial_psychi_127'].'</td>
            <td style="width:50%; border: 1px solid black">Phone: '.$data['initial_psychi_128'].'</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black">Address: '.$data['initial_psychi_129'].'</td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black">Current Psychotropic Medications: '.$data['initial_psychi_130'].'</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black">Other Medications (including OTC): '.$data['initial_psychi_131'].'</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:20%; border: 1px solid black">When: Current</td>
            <td style="width:40%; border: 1px solid black">Where: '.$data['initial_psychi_132'].'</td>
            <td style="width:40%; border: 1px solid black">Reason: '.$data['initial_psychi_133'].'</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black"><input type="checkbox" name="initial_psychi_134" value="1" '.$initial_psychi_134.'>Inpatient: '.$data['initial_psychi_135'].'</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:20%; border: 1px solid black">When: '.$data['initial_psychi_136'].'</td>
            <td style="width:40%; border: 1px solid black">Where: '.$data['initial_psychi_137'].'</td>
            <td style="width:40%; border: 1px solid black">Reason: '.$data['initial_psychi_138'].'</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:20%;"><input type="checkbox" name="initial_psychi_139" value="1" '.$initial_psychi_139.'>none</td>
            <td style="width:40%;"><input type="checkbox" name="initial_psychi_140" value="2" '.$initial_psychi_140.'>experienced</td>
            <td style="width:40%;"><input type="checkbox" name="initial_psychi_141" value="3" '.$initial_psychi_141.'>witnessed</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black"><input type="checkbox" name="initial_psychi_142" value="1" '.$initial_psychi_142.'>abuse: By whom? '.$data['initial_psychi_143'].'</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black"><input type="checkbox" name="initial_psychi_144" value="2" '.$initial_psychi_144.'>neglect: By whom? '.$data['initial_psychi_145'].'</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black"><input type="checkbox" name="initial_psychi_146" value="3" '.$initial_psychi_146.'>physical: By whom? '.$data['initial_psychi_147'].'</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black"><input type="checkbox" name="initial_psychi_148" value="4" '.$initial_psychi_148.'>emotional: By whom? '.$data['initial_psychi_149'].'</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black"><input type="checkbox" name="initial_psychi_150" value="5" '.$initial_psychi_150.'>sexual: By whom?  '.$data['initial_psychi_151'].'</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black"><input type="checkbox" name="initial_psychi_152" value="6" '.$initial_psychi_152.'>violence: By whom? '.$data['initial_psychi_153'].'</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:33%; border: 1px solid black">
             <input type="checkbox" name="initial_psychi_154" value="1" '.$initial_psychi_154.'>Smoking:
              Age you began: '.$data['initial_psychi_155'].'
            </td>
            <td style="width:33%; border: 1px solid black"></td>
            <td style="width:33%; border: 1px solid black"></td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:33%; border: 1px solid black">
             <input type="checkbox" name="initial_psychi_156" value="1" '.$initial_psychi_156.'>Alcohol:
              Age you began: '.$data['initial_psychi_157'].'
            </td>
            <td style="width:33%; border: 1px solid black">
              Age of escalation: '.$data['initial_psychi_158'].'
              Amount: '.$data['initial_psychi_159'].'
              Frequency: '.$data['initial_psychi_160'].'
              Age it became problem: '.$data['initial_psychi_161'].'
            </td>
            <td style="width:33%; border: 1px solid black">
              Date: '.$data['initial_psychi_162'].'
              Quantity: '.$data['initial_psychi_163'].'
            </td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:33%; border: 1px solid black">
             <input type="checkbox" name="initial_psychi_164" value="1" '.$initial_psychi_164.'>Seizures:
            </td>
            <td style="width:33%; border: 1px solid black">
            <input type="checkbox" name="initial_psychi_165" value="2" '.$initial_psychi_165.'>Black Outs:
            </td>
            <td style="width:33%; border: 1px solid black">
            <input type="checkbox" name="initial_psychi_166" value="3" '.$initial_psychi_166.'>DTs
            <input type="checkbox" name="initial_psychi_167" value="4" '.$initial_psychi_167.'>Tremors
            </td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:33%; border: 1px solid black">
             <input type="checkbox" name="initial_psychi_168" value="1" '.$initial_psychi_168.'>Marijuana:
            </td>
            <td style="width:33%; border: 1px solid black">
              Age of escalation: '.$data['initial_psychi_169'].'
              Amount: '.$data['initial_psychi_170'].'
              Frequency: '.$data['initial_psychi_171'].'
              Age it became problem: '.$data['initial_psychi_172'].'
            </td>
            <td style="width:33%; border: 1px solid black">
              Date: '.$data['initial_psychi_173'].'
              Quantity: '.$data['initial_psychi_174'].'
            </td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:33%; border: 1px solid black">
             <input type="checkbox" name="initial_psychi_175" value="1" '.$initial_psychi_175.'>Cocaine:
             Route of Admin: '.$data['initial_psychi_176'].'
            </td>
            <td style="width:33%; border: 1px solid black">
              Age of escalation: '.$data['initial_psychi_177'].'
              Amount: '.$data['initial_psychi_178'].'
              Frequency: '.$data['initial_psychi_179'].'
              Age it became problem: '.$data['initial_psychi_180'].'
            </td>
            <td style="width:33%; border: 1px solid black">
              Date: '.$data['initial_psychi_181'].'
              Quantity: '.$data['initial_psychi_182'].'
            </td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:33%; border: 1px solid black">
            IV: From: '.$data['initial_psychi_183'].'
            </td>
            <td style="width:33%; border: 1px solid black">
            To: '.$data['initial_psychi_184'].' &emsp;&emsp;&emsp;IN: '.$data['initial_psychi_185'].'
            </td>
            <td style="width:33%; border: 1px solid black">
              From: '.$data['initial_psychi_186'].'&emsp;&emsp;&emsp;To: '.$data['initial_psychi_187'].'
            </td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:33%; border: 1px solid black">
             <input type="checkbox" name="initial_psychi_188" value="1" '.$initial_psychi_188.'>Heroin:
            </td>
            <td style="width:33%; border: 1px solid black">
              Age of escalation: '.$data['initial_psychi_189'].'
              Amount: '.$data['initial_psychi_190'].'
              Frequency: '.$data['initial_psychi_191'].'
              Age it became problem: '.$data['initial_psychi_192'].'
            </td>
            <td style="width:33%; border: 1px solid black">
              Date: '.$data['initial_psychi_193'].'
              Quantity: '.$data['initial_psychi_194'].'
            </td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:33%; border: 1px solid black">
            <input type="checkbox" name="initial_psychi_559" value="" '.$initial_psychi_559.'>IV: From: '.$data['initial_psychi_195'].'
            </td>
            <td style="width:33%; border: 1px solid black">
            To '.$data['initial_psychi_196'].'&emsp;&emsp;&emsp;<input type="checkbox" name="initial_psychi_560" value="1" '.$initial_psychi_197.'>IN:'.$data['initial_psychi_197'].'
            </td>
            <td style="width:33%; border: 1px solid black">
              From: '.$data['initial_psychi_198'].'&emsp;&emsp;&emsp;To: '.$data['initial_psychi_199'].'
            </td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:33%; border: 1px solid black">
              <input type="checkbox" name="initial_psychi_200" value="1" '.$initial_psychi_200.'>Other Opiates:
              Fentanyl
              Oxycodone
              Hydrocodone
              Codeine
              Morphine
            </td>
            <td style="width:33%; border: 1px solid black">
              Age of escalation: '.$data['initial_psychi_201'].'
              Amount: '.$data['initial_psychi_202'].'
              Frequency: '.$data['initial_psychi_203'].'
              Age it became problem: '.$data['initial_psychi_204'].'
            </td>
            <td style="width:33%; border: 1px solid black">
              Date: '.$data['initial_psychi_205'].'
              Quantity: '.$data['initial_psychi_206'].'
            </td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:33%; border: 1px solid black">
            <input type="checkbox" name="initial_psychi_561" value="1" '.$initial_psychi_561.'>IV: From:'.$data['initial_psychi_207'].'
            </td>
            <td style="width:33%; border: 1px solid black">
            To '.$data['initial_psychi_208'].' &emsp;&emsp;&emsp;<input type="checkbox" name="initial_psychi_562" value="1" '.$initial_psychi_562.'>IN: '.$data['initial_psychi_209'].'
            </td>
            <td style="width:33%; border: 1px solid black">
              From: '.$data['initial_psychi_210'].' &emsp;&emsp;&emsp;To: '.$data['initial_psychi_211'].'
            </td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:33%; border: 1px solid black">
              <input type="checkbox" name="initial_psychi_212" value="1" '.$initial_psychi_212.'>Amphetamines:
            </td>
            <td style="width:33%; border: 1px solid black">
              Age of escalation: '.$data['initial_psychi_213'].'
              Amount: '.$data['initial_psychi_214'].'
              Frequency: '.$data['initial_psychi_215'].'
              Age it became problem: '.$data['initial_psychi_216'].'
            </td>
            <td style="width:33%; border: 1px solid black">
              Date: '.$data['initial_psychi_217'].'
              Quantity: '.$data['initial_psychi_218'].'
            </td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:33%; border: 1px solid black">
            <input type="checkbox" name="initial_psychi_563" value="1" '.$initial_psychi_563.'>IV: From: '.$data['initial_psychi_219'].'
            </td>
            <td style="width:33%; border: 1px solid black">
            To '.$data['initial_psychi_220'].'&emsp;&emsp;&emsp;<input type="checkbox" name="initial_psychi_564" value="1" '.$initial_psychi_564.'>IN: '.$data['initial_psychi_221'].'
            </td>
            <td style="width:33%; border: 1px solid black">
              From: '.$data['initial_psychi_222'].' &emsp;&emsp;&emsp;To: '.$data['initial_psychi_223'].'
            </td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:33%;  border: 1px solid black">
              <input type="checkbox" name="initial_psychi_224" value="1" '.$initial_psychi_224.'>Hallucinogens: '.$data['initial_psychi_225'].'
            </td>
            <td style="width:33%; border: 1px solid black">
            </td>
            <td style="width:33%; border: 1px solid black">
            </td>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:33%;  border: 1px solid black">
              <input type="checkbox" name="initial_psychi_226" value="1" '.$initial_psychi_226.'>LSD, K, PCP, others: '.$data['initial_psychi_227'].'
            </td>
            <td style="width:33%; border: 1px solid black">
            </td>
            <td style="width:33%; border: 1px solid black">
            </td>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:33%; border: 1px solid black">
            <input type="checkbox" name="initial_psychi_565" value="1" '.$initial_psychi_565.'>IV: From: '.$data['initial_psychi_228'].'
            </td>
            <td style="width:33%; border: 1px solid black">
            To '.$data['initial_psychi_229'].'&emsp;&emsp;&emsp;<input type="checkbox" name="initial_psychi_566" value="1" '.$initial_psychi_566.'>IN: '.$data['initial_psychi_230'].'
            </td>
            <td style="width:33%; border: 1px solid black">
              From: '.$data['initial_psychi_231'].' &emsp;&emsp;&emsp;To: '.$data['initial_psychi_232'].'
            </td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:33%; border: 1px solid black">
              <input type="checkbox" name="initial_psychi_233" value="1" '.$initial_psychi_233.'>benzodiazepines: '.$data['initial_psychi_234'].'
            </td>
            <td style="width:33%; border: 1px solid black">
              Age of escalation: '.$data['initial_psychi_235'].'
              Amount: '.$data['initial_psychi_236'].'
              Frequency: '.$data['initial_psychi_237'].'
              Age it became problem: '.$data['initial_psychi_238'].'
            </td>
            <td style="width:33%; border: 1px solid black">
              Date: '.$data['initial_psychi_239'].'
              Quantity: '.$data['initial_psychi_240'].'
            </td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:33%; border: 1px solid black">
            <input type="checkbox" name="initial_psychi_567" value="1" '.$initial_psychi_567.'>IV: From: '.$data['initial_psychi_241'].'
            </td>
            <td style="width:33%; border: 1px solid black">
            To '.$data['initial_psychi_242'].'&emsp;&emsp;&emsp;<input type="checkbox" name="initial_psychi_568" value="1" '.$initial_psychi_568.'>IN: '.$data['initial_psychi_243'].'
            </td>
            <td style="width:33%; border: 1px solid black">
              From: '.$data['initial_psychi_244'].' &emsp;&emsp;&emsp;To: '.$data['initial_psychi_245'].'
            </td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black">
              <input type="checkbox" name="initial_psychi_246" value="1" '.$initial_psychi_246.'>inhalants:
            </td>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td>
              <input type="checkbox" name="initial_psychi_247" value="1" '.$initial_psychi_247.'>Sobriety: '.$data['initial_psychi_248'].'
            </td>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td>
              <input type="checkbox" name="initial_psychi_249" value="2" '.$initial_psychi_249.'>How long: '.$data['initial_psychi_250'].'
            </td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td>
              <input type="checkbox" name="initial_psychi_251" value="1" '.$initial_psychi_251.'>Others:
            </td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td>
              Spiritual beliefs: '.$data['initial_psychi_252'].'
            </td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td>
              Religiosity: '.$data['initial_psychi_253'].'
            </td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td>
              AA/ 12 Steps: {Yes/No} '.$data['initial_psychi_254'].'
            </td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td>
            Substance Abuse Treatment History:
            </td>
          </tr>
        </table>
        <table style="width:100%;">
          <tr>
            <td style="width:20%;">
              Facility Name '.$data['initial_psychi_255'].'
            </td>
            <td style="width:20%;">
              When? '.$data['initial_psychi_256'].'
            </td>
            <td style="width:20%;">
              Length of Tx '.$data['initial_psychi_257'].'
            </td>
            <td style="width:20%;">
              Completed? '.$data['initial_psychi_258'].'
            </td>
            <td style="width:20%;">
              Outcome '.$data['initial_psychi_259'].'
            </td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td><input type="checkbox" name="initial_psychi_260" value="1" '.$initial_psychi_260.'>Denied</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td><input type="checkbox" name="initial_psychi_261" value="1" '.$initial_psychi_261.'>DUI’s: '.$data['initial_psychi_262'].' &emsp; '.$data['initial_psychi_263'].'</td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
        <tr>
          <td><input type="checkbox" name="initial_psychi_264" value="1" '.$initial_psychi_264.'>Arrests: When?'.$data['initial_psychi_265'].' &emsp;&emsp;&emsp;&emsp; For What?  '.$data['initial_psychi_266'].'</td>
        </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
        <tr>
          <td><input type="checkbox" name="initial_psychi_267" value="1" '.$initial_psychi_267.'>Incarcerations: '.$data['initial_psychi_268'].' &emsp;&emsp;&emsp;&emsp; For What? '.$data['initial_psychi_269'].'</td>
        </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
        <tr>
          <td><input type="checkbox" name="initial_psychi_270" value="1" '.$initial_psychi_270.'>Convictions: '.$data['initial_psychi_271'].' &emsp;&emsp;&emsp;&emsp; For What? '.$data['initial_psychi_272'].' </td>
        </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
        <tr>
          <td><input type="checkbox" name="initial_psychi_273" value="1" '.$initial_psychi_273.'>Probation/ Parole: '.$data['initial_psychi_274'].'  &emsp;&emsp;&emsp;&emsp; For What? '.$data['initial_psychi_275'].' </td>
        </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
        <tr>
          <td><input type="checkbox" name="initial_psychi_276" value="1" '.$initial_psychi_276.'>PINS: Not reported</td>
        </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
        <tr>
          <td><input type="checkbox" name="initial_psychi_277" value="1" '.$initial_psychi_277.'>Other: Not reported</td>
        </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
        <tr>
          <td>HIPPA Release Signed for: <input type="checkbox" name="initial_psychi_278" value="1" '.$initial_psychi_278.'>Probation Officer <input type="checkbox" name="initial_psychi_279" value="2" '.$initial_psychi_279.'>Parole Officer
          <input type="checkbox" name="initial_psychi_280" value="3" '.$initial_psychi_280.'>Court  <input type="checkbox" name="initial_psychi_570" value="4" '.$initial_psychi_570.'>Lawyer  <input type="checkbox" name="initial_psychi_281" value="5" '.$initial_psychi_281.'>IDRC  <input type="checkbox" name="initial_psychi_282" value="6" '.$initial_psychi_282.'>Other:</td>
        </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
        <tr>
          <td><input type="checkbox" name="initial_psychi_283" value="1" '.$initial_psychi_283.'>None </td>
        </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
        <tr>
          <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_284" value="1" '.$initial_psychi_284.'>Allergies: &emsp;<input type="checkbox" name="initial_psychi_285" value="2" '.$initial_psychi_285.'>NKDA &emsp;<input type="checkbox" name="initial_psychi_286" value="3" '.$initial_psychi_286.'>Yes '.$data['initial_psychi_287'].'</td>
          <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_288" value="1" '.$initial_psychi_287.'>Heart Disease </td>
        </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
        <tr>
          <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_289" value="2" '.$initial_psychi_289.'>HTN </td>
          <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_290" value="3" '.$initial_psychi_290.'>
          Lung disease </td>
        </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psyc1hi_291" value="4" '.$initial_psychi_291.'>Asthma </td>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_292" value="5" '.$initial_psychi_292.'>
            DM </td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_293" value="6" '.$initial_psychi_293.'>Head trauma </td>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_294" value="7" '.$initial_psychi_294.'>Seizure disorder
            </td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_295" value="8" '.$initial_psychi_295.'>Liver </td>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_296" value="9" '.$initial_psychi_296.'>Kidney</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_297" value="10" '.$initial_psychi_297.'>Thyroid </td>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_298" value="11" '.$initial_psychi_298.'>
            Diabetes</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_299" value="12" '.$initial_psychi_299.'>Ulcer/ reflux </td>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_300" value="13" '.$initial_psychi_300.'>Migraines</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_301" value="14" '.$initial_psychi_301.'>Eye problems </td>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_302" value="15" '.$initial_psychi_302.'>Hypertension</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_303" value="1" '.$initial_psychi_303.'>
            <p>Psychiatric disorders:  </p>
            <p> '.$data['initial_psychi_304'].' </p>
            <p> '.$data['initial_psychi_305'].' </p>
            <p> '.$data['initial_psychi_306'].' </p>
             </p>
            <p>Psychiatric disorders: </p>
            </td>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_307" value="1" '.$initial_psychi_307.'>Learning disabilities</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_308" value="2" '.$initial_psychi_308.'>Cancer</td>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_309" value="3" '.$initial_psychi_309.'>Other:</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_310" value="1" '.$initial_psychi_310.'>HIV risk factors: <input type="checkbox" name="initial_psychi_311" value="2" '.$initial_psychi_311.'>IVDU <input type="checkbox" name="initial_psychi_312" value="3" '.$initial_psychi_312.'>Unprotected Sex <input type="checkbox" name="initial_psychi_313" value="4" '.$initial_psychi_313.'>Psychiatric Acute Illness: Date and reason for hospitalization '.$data['initial_psychi_314'].'
            </td>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_315" value="1" '.$initial_psychi_315.'>Immunizations: Up to date</td>
          </tr>
        </table>

        <table>
          <tr>
            <td>
              <p><input type="checkbox" name="initial_psychi_316" value="1" '.$initial_psychi_316.'><b>Menstrual History:</b></p>
              <p><b>Menarche:</b> '.$data['initial_psychi_317'].'</p>
              <p><b>Regularity:</b> <input type="checkbox" name="initial_psychi_318" value="1" '.$initial_psychi_318.'>Regular &emsp;<input type="checkbox" name="initial_psychi_319" value="2" '.$initial_psychi_319.'>Irregular &emsp;<input type="checkbox" name="initial_psychi_320" value="3" '.$initial_psychi_320.'>Amenorrhea: &emsp;Since When: '.$data['initial_psychi_321'].'</p>

              <p><b>Duration:</b> <input type="checkbox" name="initial_psychi_322" value="1" '.$initial_psychi_322.'>21 Days &emsp;<input type="checkbox" name="initial_psychi_323" value="2" '.$initial_psychi_323.'>30 Days <input type="checkbox" name="initial_psychi_324" value="1" '.$initial_psychi_324.'>21 <Days: &emsp;<input type="checkbox" name="initial_psychi_325" value="4" '.$initial_psychi_325.'>30 >Days</p>

              <p><b>OC:</b> <input type="checkbox" name="initial_psychi_326" value="1" '.$initial_psychi_326.'>On Pills Name: '.$data['initial_psychi_327'].'<input type="checkbox" name="initial_psychi_328" value="2" '.$initial_psychi_328.'>On IUD: '.$data['initial_psychi_329'].' Since: '.$data['initial_psychi_330'].'</p>

              <p><b>Related to mood: </b><input type="checkbox" name="initial_psychi_331" value="1" '.$initial_psychi_331.'>N/A <input type="checkbox" name="initial_psychi_332" value="2" '.$initial_psychi_332.'>Before Menstruation <input type="checkbox" name="initial_psychi_333" value="3" '.$initial_psychi_333.'>Yes <input type="checkbox" name="initial_psychi_334" value="4"  '.$initial_psychi_334.'>No</p>

              <p><input type="checkbox" name="initial_psychi_335" value="1" '.$initial_psychi_335.'>After Menstruation <input type="checkbox" name="initial_psychi_336" value="2" '.$initial_psychi_3336.'>Yes <input type="checkbox" name="initial_psychi_337" value="3" '.$initial_psychi_337.'>No</p>

              <p>Violent Behavior <input type="checkbox" name="initial_psychi_338" value="1" '.$initial_psychi_338.'>Yes <input type="checkbox" name="initial_psychi_339" value="2" '.$initial_psychi_339.'>No  </p>
            </td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black">
              <input type="checkbox" name="initial_psychi_340" value="1" '.$initial_psychi_340.'>Illnesses (include age): '.$data['initial_psychi_341'].'
            </td>
            <td style="width:50%; border: 1px solid black">
              <input type="checkbox" name="initial_psychi_342" value="2" '.$initial_psychi_342.'>Accidents (include age): '.$data['initial_psychi_343'].'
            </td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black">
              <input type="checkbox" name="initial_psychi_344" value="1" '.$initial_psychi_344.'>Medical hospitalizations (include age):
              <p>'.$data['initial_psychi_345'].'</p> &emsp;<p>'.$data['initial_psychi_346'].'</p>
              <p>'.$data['initial_psychi_347'].'</p> &emsp; <p>'.$data['initial_psychi_348'].'</p>
              <p>'.$data['initial_psychi_349'].'</p> &emsp; <p>'.$data['initial_psychi_350'].'</p>
            </td>
            <td style="width:50%; border: 1px solid black">
              <input type="checkbox" name="initial_psychi_351" value="1" '.$initial_psychi_351.'>Surgeries (include age):
              <p>'.$data['initial_psychi_352'].'</p> &emsp;<p>'.$data['initial_psychi_353'].'</p>
              <p>'.$data['initial_psychi_354'].'</p> &emsp; <p>'.$data['initial_psychi_355'].'</p>
              <p>'.$data['initial_psychi_356'].'</p> &emsp; <p>'.$data['initial_psychi_357'].'</p>
            </td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black">
              <p><input type="checkbox" name="initial_psychi_358" value="1" '.$initial_psychi_358.'>Suicide risk:</p>
              <p><input type="checkbox" name="initial_psychi_359" value="2" '.$initial_psychi_359.'>SPrior Attempts &emsp;<input type="checkbox" name="initial_psychi_360" value="3" '.$initial_psychi_360.'>Yes <input type="checkbox" name="initial_psychi_361" value="4" '.$initial_psychi_361.'>No</p>

              <p><input type="checkbox" name="initial_psychi_362" value="5" '.$initial_psychi_362.'>Passive Suicidal Ideation &emsp;<input type="checkbox" name="initial_psychi_363" value="6" '.$initial_psychi_363.'>Plan  <input type="checkbox" name="initial_psychi_364" value="7" '.$initial_psychi_364.'>Noplan </p>

              <p>Active Suicidal Ideation &emsp;<input type="checkbox" name="initial_psychi_365" value="8" '.$initial_psychi_365.'>Plan <input type="checkbox" name="initial_psychi_366" value="9" '.$initial_psychi_366.'>Noplan</p>
            </td>
            <td style="width:50%; border: 1px solid black">
              <p><input type="checkbox" name="initial_psychi_367" value="1" '.$initial_psychi_367.'>Personal safety:</p>
              <p>Access to Firearms:&emsp;<input type="checkbox" name="initial_psychi_368" value="2" '.$initial_psychi_368.'>Yes <input type="checkbox" name="initial_psychi_369" value="3" '.$initial_psychi_369.'>No</p>
              <p>SI:&emsp;<input type="checkbox" name="initial_psychi_370" value="1" '.$initial_psychi_370.'>Yes <input type="checkbox" name="initial_psychi_371" value="2" '.$initial_psychi_371.'>No</p>
              <p>HI:&emsp;<input type="checkbox" name="initial_psychi_372" value="1" '.$initial_psychi_372.'>Yes <input type="checkbox" name="initial_psychi_373" value="2" '.$initial_psychi_373.'>No</p>
              <p>Rage:&emsp;<input type="checkbox" name="initial_psychi_374" value="1" '.$initial_psychi_374.'>Yes <input type="checkbox" name="initial_psychi_375" value="2" '.$initial_psychi_375.'>No</p>
            </td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black">
              <p><input type="checkbox" name="initial_psychi_376" value="1" '.$initial_psychi_376.'>Risk to others <input type="checkbox" name="initial_psychi_377" value="2" '.$initial_psychi_377.'>IVDU <input type="checkbox" name="initial_psychi_378" value="3" '.$initial_psychi_378.'>Unsafe Sex <input type="checkbox" name="initial_psychi_379" value="4" '.$initial_psychi_379.'>DUI </p>
              <p><input type="checkbox" name="initial_psychi_380" value="5" '.$initial_psychi_380.'>Risky Behaviors Related to Substance Use <input type="checkbox" name="initial_psychi_381" value="6" '.$initial_psychi_381.'>All</p>
            </td>
            <td style="width:50%; border: 1px solid black">
              <p><input type="checkbox" name="initial_psychi_382" value="1" '.$initial_psychi_382.'> Personal Strengths:</p>
              <p>'.$data['initial_psychi_383'].'</p>
              <p>'.$data['initial_psychi_384'].'</p>
            </td>
          </tr>
        </table>

        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black">
              <p>Literacy level:<input type="checkbox" name="initial_psychi_385" value="1" '.$initial_psychi_385.'>High School <input type="checkbox" name="initial_psychi_386" value="1" '.$initial_psychi_386.'>College   <input type="checkbox" name="initial_psychi_387" value="1" '.$initial_psychi_387.'>Illiterate &emsp; '.$data['initial_psychi_569'].'</p>
            </td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black">
              <p>Need for assistive technology in the provision of services: None</p>
            </td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black">
              <p>Advanced directive when applicable: "'.$data['when_applicable'].'"</p>
            </td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="border: 1px solid black">
              <p>Psychological and social adjustments to disabilities and/ or disorders: "'.$data['disorder'].'"</p>
            </td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_388" value="1" '.$initial_psychi_388.'>None</td>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_389" value="2" '.$initial_psychi_389.' >Heart Disease</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_390" value="3" '.$initial_psychi_390.'>Hypertension</td>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_391" value="4" '.$initial_psychi_391.'>CVA</td>
          </tr>
        </table><table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_392" value="5" '.$initial_psychi_392.'>Lung Disease</td>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_393" value="6" '.$initial_psychi_393.'>Asthma</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_394" value="7" '.$initial_psychi_394.'>DM</td>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_395" value="8" '.$initial_psychi_395.'>Head Trauma</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_396" value="9" '.$initial_psychi_396.'>Cancer</td>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_397" value="10" '.$initial_psychi_397.'>Eye problems</td>
          </tr>
        </table>
        <table style="width:100%; border: 1px solid black">
          <tr>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_398" value="11" '.$initial_psychi_398.'>Seizure Disorder</td>
            <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_399" value="12" '.$initial_psychi_399.'>Liver</td>
          </tr>
      </table>
      <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_400" value="13" '.$initial_psychi_400.'>Kidney</td>
        <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_401" value="14" '.$initial_psychi_401.'>Thyroid</td>
      </tr>
      </table>
      <table style="width:100%; border: 1px solid black">
        <tr>
          <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_402" value="15" '.$initial_psychi_402.'>Congenital Abnormalities</td>
          <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_403" value="16" '.$initial_psychi_403.'>Learning difficulties</td>
        </tr>
      </table>
      <table style="width:100%; border: 1px solid black">
        <tr>
          <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_404" value="17" '.$initial_psychi_404.'>Psychiatric Disorders</td>
          <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_405" value="18" '.$initial_psychi_405.'>Suicide Not reported</td>
        </tr>
      </table>
      <table style="width:100%; border: 1px solid black">
        <tr>
          <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_406" value="19" '.$initial_psychi_406.'>Substance abuse</td>
          <td style="width:50%; border: 1px solid black"><input type="checkbox" name="initial_psychi_407" value="20" '.$initial_psychi_407.'>Others: '.$data['initial_psychi_408'].'</td>
        </tr>
      </table>

      <table style="width:100%; border: 1px solid black">
        <tr>
          <td style="width:33%; border: 1px solid black">
            <p>Gender</p>
            <p><input type="checkbox" name="initial_psychi_409" value="1" '.$initial_psychi_409.'>Male <input type="checkbox" name="initial_psychi_410" value="2" '.$initial_psychi_410.'>Female</p>
            <p><input type="checkbox" name="initial_psychi_411" value="3" '.$initial_psychi_411.'>Transgender</p>
          </td>
          <td style="width:33%; border: 1px solid black">
            <p>Gender Expressions:</p>
            <p><input type="checkbox" name="initial_psychi_412" value="1" '.$initial_psychi_412.'>Male</p>
            <p><input type="checkbox" name="initial_psychi_413" value="2" '.$initial_psychi_413.'>Female</p>
            <p><input type="checkbox" name="initial_psychi_414" value="3" '.$initial_psychi_414.'>Transgender</p>
          </td>
          <td style="width:33%; border: 1px solid black">
            <p>Sexual Orientation:</p>
            <p><input type="checkbox" name="initial_psychi_415" value="1" '.$initial_psychi_415.'>Heterosexual</p>
            <p><input type="checkbox" name="initial_psychi_416" value="2" '.$initial_psychi_416.'>Homosexual</p>
            <p><input type="checkbox" name="initial_psychi_417" value="3" '.$initial_psychi_417.'>Pansexual &emsp;<input type="checkbox" name="initial_psychi_418" value="4" '.$initial_psychi_418.'>Asexual</p>
          </td>
        </tr>
      </table>

      <table style="width:100%; border: 1px solid black">
        <tr>
          <td style="width:100%; border: 1px solid black">
            <p>Appearance:<input type="checkbox" name="initial_psychi_419" value="1" '.$initial_psychi_419.'>appropriate <input type="checkbox" name="initial_psychi_420" value="2" '.$initial_psychi_420.'>well kept <input type="checkbox" name="initial_psychi_421" value="3" '.$initial_psychi_421.' >disheveled <input type="checkbox" name="initial_psychi_422" value="4" '.$initial_psychi_422.'>bizarre</p>
            <p>Describe: '.$data['initial_psychi_423'].'</p>
          </td>
        </tr>
      </table>

      <table style="width:100%; border: 1px solid black">
        <tr>
          <td style="width:100%; border: 1px solid black">
            <p>Musculoskeletal: &emsp; Strength/ Tone<input type="checkbox" name="initial_psychi_424" value="1" '.$initial_psychi_424.'>normal <input type="checkbox" name="initial_psychi_425" value="2" '.$initial_psychi_425.'>abnormal &emsp; Gait/Station<input type="checkbox" name="initial_psychi_426" value="3" '.$initial_psychi_426.'>normal <input type="checkbox" name="initial_psychi_427" value="4" '.$initial_psychi_427.'>abnormal</p>
            <p>Describe: '.$data['initial_psychi_428'].'</p>
          </td>
        </tr>
      </table>

      <table style="width:100%; border: 1px solid black">
        <tr>
          <td style="width:100%; border: 1px solid black">
            <p>Attitude: &emsp;&emsp; cooperativeness &emsp;&emsp; relatedness &emsp;&emsp; good eye contact &emsp;&emsp; uncooperative</p>
            <p>Describe: '.$data['initial_psychi_429'].'</p>
          </td>
        </tr>
      </table>

      <table style="width:100%; border: 1px solid black">
        <tr>
          <td style="width:100%; border: 1px solid black">
            <p>Motor: &emsp;<input type="checkbox" name="initial_psychi_430" value="1" '.$initial_psychi_430.'>normal <input type="checkbox" name="initial_psychi_431" value="2" '.$initial_psychi_431.'>psychomotor agitation &emsp; <input type="checkbox" name="initial_psychi_432" value="3" '.$initial_psychi_432.'>psycho motor retardation <input type="checkbox" name="initial_psychi_433" value="4" '.$initial_psychi_433.'>EPS <input type="checkbox" name="initial_psychi_434" value="5" '.$initial_psychi_434.'>tremor  <input type="checkbox" name="initial_psychi_435" value="6" '.$initial_psychi_435.'>AIMS: </p>
          </td>
        </tr>
      </table>

      <table style="width:100%; border: 1px solid black">
        <tr>
          <td style="width:100%; border: 1px solid black">
            <p>Speech: &emsp;<input type="checkbox" name="initial_psychi_436" value="1" '.$initial_psychi_436.'>normal <input type="checkbox" name="initial_psychi_437" value="2" '.$initial_psychi_437.'>hyperactive  &emsp; <input type="checkbox" name="initial_psychi_438" value="3" '.$initial_psychi_438.'>retardation  <input type="checkbox" name="initial_psychi_439" value="4" '.$initial_psychi_439.'>abnormal movements <input type="checkbox" name="initial_psychi_440" value="5" '.$initial_psychi_4440.'>slurred  <input type="checkbox" name="initial_psychi_441" value="6" '.$initial_psychi_441.'>Orobuccal Movement <input type="checkbox" name="initial_psychi_442" value="7" '.$initial_psychi_442.'>Pressured  <input type="checkbox" name="initial_psychi_443" value="8" '.$initial_psychi_443.'>Loud  <input type="checkbox" name="initial_psychi_444" value="9" '.$initial_psychi_444.'>Monotonous <input type="checkbox" name="initial_psychi_445" value="10" '.$initial_psychi_445.'>Tremulous </p>
            <p>Describe:'.$data['initial_psychi_446'].'</p>
          </td>
        </tr>
      </table>

      <table style="width:100%; border: 1px solid black">
        <tr>
          <td style="width:100%; border: 1px solid black">
            <p>Mood: &emsp;<input type="checkbox" name="initial_psychi_447" value="1" '.$initial_psychi_447.'>euthymic  <input type="checkbox" name="initial_psychi_448" value="2" '.$initial_psychi_448.'>depressed  &emsp; <input type="checkbox" name="initial_psychi_449" value="1" '.$initial_psychi_449.'>hypomanic  <input type="checkbox" name="initial_psychi_450" value="1" '.$initial_psychi_450.'>euphoric  <input type="checkbox" name="initial_psychi_451" value="1" '.$initial_psychi_451.'>angry <input type="checkbox" name="initial_psychi_452" value="1" '.$initial_psychi_452.'>anxious <input type="checkbox" name="initial_psychi_453" value="7" '.$initial_psychi_453.'>labile </p>
            <p>Describe: '.$data['initial_psychi_454'].'</p>
          </td>
        </tr>
      </table>

      <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>Affect: Appropriateness: &emsp;<input type="checkbox" name="initial_psychi_455" value="1" '.$initial_psychi_455.'>Appropriate  <input type="checkbox" name="initial_psychi_456" value="2" '.$initial_psychi_456.'>Inappropriate  <input type="checkbox" name="initial_psychi_457" value="3" '.$initial_psychi_457.'>Incongruous  </p>

          <p>Range: &emsp;<input type="checkbox" name="initial_psychi_458" value="1" '.$initial_psychi_458.'>Blunted   <input type="checkbox" name="initial_psychi_459" value="2" '.$initial_psychi_459.'>Restricted   <input type="checkbox" name="initial_psychi_460" value="3" '.$initial_psychi_460.'>Flat <input type="checkbox" name="initial_psychi_461" value="4" '.$initial_psychi_461.'>Expansive   </p>

          <p>Stability: &emsp;<input type="checkbox" name="initial_psychi_462" value="1" '.$initial_psychi_462.'>Stable   <input type="checkbox" name="initial_psychi_463" value="2" '.$initial_psychi_463.'>Labile</p>
          <p>Describe: '.$data['initial_psychi_464'].'</p>
        </td>
      </tr>
    </table>

    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>Thought Process: &emsp;<input type="checkbox" name="initial_psychi_465" value="1" '.$initial_psychi_465.'>coherent   <input type="checkbox" name="initial_psychi_466" value="2" '.$initial_psychi_466.'>soft   <input type="checkbox" name="initial_psychi_467" value="3" '.$initial_psychi_467.'>loose associations <input type="checkbox" name="initial_psychi_468" value="4" '.$initial_psychi_468.'>flight of ideas   <input type="checkbox" name="initial_psychi_469" value="5" '.$initial_psychi_469.'>slurred   <input type="checkbox" name="initial_psychi_470" value="6" '.$initial_psychi_470.'>Tangential thinking <input type="checkbox" name="initial_psychi_471" value="7" '.$initial_psychi_471.'>Nonsense words/word salad <input type="checkbox" name="initial_psychi_472" value="8" '.$initial_psychi_472.'>Thought Blocking   <input type="checkbox" name="initial_psychi_473" value="9" '.$initial_psychi_473.'>Thought Racing</p>
          <p>Describe: '.$data['initial_psychi_474'].'</p>
        </td>
      </tr>
    </table>

    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>Thought Associations: &emsp;<input type="checkbox" name="initial_psychi_475" value="1" '.$initial_psychi_475.'>intact    <input type="checkbox" name="initial_psychi_476" value="2" '.$initial_psychi_476.'>circumstantial  <input type="checkbox" name="initial_psychi_478" value="3" '.$initial_psychi_478.'>tangential  <input type="checkbox" name="initial_psychi_479" value="4" '.$initial_psychi_479.'>loose</p>
          <p>Describe: '.$data['initial_psychi_480'].'</p>
        </td>
      </tr>
    </table>

    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>Thought Content: &emsp;<input type="checkbox" name="initial_psychi_481" value="1" '.$initial_psychi_481.'>None    <input type="checkbox" name="initial_psychi_482" value="2" '.$initial_psychi_482.'>Delusions    <input type="checkbox" name="initial_psychi_483" value="3" '.$initial_psychi_483.'>Overvalued ideas  <input type="checkbox" name="initial_psychi_484" value="4" '.$initial_psychi_484.'>preoccupations  <input type="checkbox" name="initial_psychi_485" value="5" '.$initial_psychi_485.'>Depressive Thoughts  <input type="checkbox" name="initial_psychi_486" value="6" '.$initial_psychi_486.'>Self-harm <input type="checkbox" name="initial_psychi_487" value="7" '.$initial_psychi_487.'>Suicidal Ideations <input type="checkbox" name="initial_psychi_488" value="8" '.$initial_psychi_488.'>TAggressive or Homicidal Ideations</p>
          <p>Describe: '.$data['initial_psychi_489'].'</p>
        </td>
      </tr>
    </table>

    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>Perception: Dissociative symptoms: &emsp;<input type="checkbox" name="initial_psychi_490" value="1" '.$initial_psychi_490.'>Derealization    <input type="checkbox" name="initial_psychi_491" value="2" '.$initial_psychi_491.'>Depersonalization </p>
          <p><input type="checkbox" name="initial_psychi_492" value="3" '.$initial_psychi_492.'>Illusions </p>
          <p>Hallucinations:<input type="checkbox" name="initial_psychi_493" value="4" '.$initial_psychi_493.'>Visual &emsp;<input type="checkbox" name="initial_psychi_494" value="5" '.$initial_psychi_494.'>Tactile  &emsp;<input type="checkbox" name="initial_psychi_495" value="6" '.$initial_psychi_495.'>Auditory  &emsp;<input type="checkbox" name="initial_psychi_496" value="7" '.$initial_psychi_496.'>Command &emsp;</p>
          <p>Describe: '.$data['initial_psychi_497'].'</p>
        </td>
      </tr>
    </table>

    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>Memory: Recent  &emsp;<input type="checkbox" name="initial_psychi_498" value="1" '.$initial_psychi_498.'>intact  <input type="checkbox" name="initial_psychi_499" value="2" '.$initial_psychi_499.'>impaired  <input type="checkbox" name="initial_psychi_500" value="3" '.$initial_psychi_500.'>digits forward Remote <input type="checkbox" name="initial_psychi_501" value="4" '.$initial_psychi_501.'>intact  <input type="checkbox" name="initial_psychi_502" value="5" '.$initial_psychi_502.'>impaired</p>
          <p>Describe: '.$data['initial_psychi_503'].'</p>
        </td>
      </tr>
    </table>

    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>Judgment  &emsp;<input type="checkbox" name="initial_psychi_504" value="1" '.$initial_psychi_504.' >poor   <input type="checkbox" name="initial_psychi_50" value="2" '.$initial_psychi_505.'>fair   <input type="checkbox" name="initial_psychi_506" value="3" '.$initial_psychi_506.'>good Insight <input type="checkbox" name="initial_psychi_507" value="4" '.$initial_psychi_507.'>minimal  <input type="checkbox" name="initial_psychi_508" value="5" '.$initial_psychi_508.'>moderate <input type="checkbox" name="initial_psychi_509" value="6" '.$initial_psychi_509.'> good</p>
          <p>Describe: '.$data['initial_psychi_510'].'</p>
        </td>
      </tr>
    </table>

    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>Orientation  &emsp;<input type="checkbox" name="initial_psychi_511" value="1" '.$initial_psychi_511.'>time  <input type="checkbox" name="initial_psychi_512" value="2" '.$initial_psychi_512.'>person  <input type="checkbox" name="initial_psychi_513" value="3" '.$initial_psychi_513.'>place  Attention Span/ Concentration<input type="checkbox" name="initial_psychi_514" value="4" '.$initial_psychi_514.'>intact   <input type="checkbox" name="initial_psychi_515" value="5" '.$initial_psychi_515.'>impaired </p>
          <p>Describe: '.$data['initial_psychi_516'].'</p>
        </td>
      </tr>
    </table>

    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>Language Name Objects  &emsp;<input type="checkbox" name="initial_psychi_517" value="1" '.$initial_psychi_517.'>intact   <input type="checkbox" name="initial_psychi_518" value="2" '.$initial_psychi_518.'>impaired  <input type="checkbox" name="initial_psychi_519" value="3" '.$initial_psychi_519.'>place  Repeat phrases <input type="checkbox" name="initial_psychi_520" value="4" '.$initial_psychi_520.'>intact   <input type="checkbox" name="initial_psychi_521" value="5" '.$initial_psychi_521.'>impaired </p>
        </td>
      </tr>
    </table>

    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>Knowledge Current Events &emsp;<input type="checkbox" name="initial_psychi_522" value="1" '.$initial_psychi_522.'>intact   <input type="checkbox" name="initial_psychi_523" value="2" '.$initial_psychi_523.'>impaired  <input type="checkbox" name="initial_psychi_524" value="3" '.$initial_psychi_524.'>place  Repeat phrases <input type="checkbox" name="initial_psychi_525" value="4" '.$initial_psychi_525.'>intact   <input type="checkbox" name="initial_psychi_526" value="5" '.$initial_psychi_526.'>impaired </p>
        </td>
      </tr>
    </table>
    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>Intelligence  &emsp;<input type="checkbox" name="initial_psychi_527" value="1"'.$initial_psychi_527.' >appears normal    <input type="checkbox" name="initial_psychi_528" value="2" '.$initial_psychi_528.'>age appropriate  <input type="checkbox" name="initial_psychi_529" value="3" '.$initial_psychi_529.'>age inappropriate</p>
          <p>Describe: '.$data['initial_psychi_530'].'</p>
        </td>
      </tr>
    </table>
    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>Insight:  &emsp;<input type="checkbox" name="initial_psychi_531" value="1" '.$initial_psychi_531.'>poor <input type="checkbox" name="initial_psychi_532" value="2" '.$initial_psychi_532.'>Fair <input type="checkbox" name="initial_psychi_533" value="3" '.$initial_psychi_533.'> moderate  <input type="checkbox" name="initial_psychi_534" value="4" '.$initial_psychi_534.'> good</p>
          <p>Describe: '.$data['initial_psychi_535'].'</p>
        </td>
      </tr>
    </table>
    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>Self-Esteem:  &emsp;<input type="checkbox" name="initial_psychi_536" value="1" '.$initial_psychi_536.'>poor <input type="checkbox" name="initial_psychi_537" value="2" '.$initial_psychi_537.'>Fair <input type="checkbox" name="initial_psychi_538" value="3" '.$initial_psychi_538.'> moderate  <input type="checkbox" name="initial_psychi_539" value="4" '.$initial_psychi_539.'> good</p>
          <p>Describe: '.$data['initial_psychi_540'].'</p>
        </td>
      </tr>
    </table>
    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>Impulse Control:  &emsp;<input type="checkbox" name="initial_psychi_541" value="1" '.$initial_psychi_541.'>poor <input type="checkbox" name="initial_psychi_542" value="2"  '.$initial_psychi_542.'>Fair <input type="checkbox" name="initial_psychi_543" value="3" '.$initial_psychi_543.'> moderate  <input type="checkbox" name="initial_psychi_544" value="4" '.$initial_psychi_544.'> good</p>
          <p>Describe:'.$data['initial_psychi_545'].'</p>
        </td>
      </tr>
    </table>
    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>Motivation/ Involvement:  &emsp;<input type="checkbox" name="initial_psychi_546" value="1" '.$initial_psychi_546.'>poor <input type="checkbox" name="initial_psychi_547" value="2" '.$initial_psychi_547.'>Fair <input type="checkbox" name="initial_psychi_548" value="3" '.$initial_psychi_548.'> moderate  <input type="checkbox" name="initial_psychi_549" value="4" '.$initial_psychi_549.'> good</p>
          <p>Describe: '.$data['initial_psychi_450'].'</p>
        </td>
      </tr>
    </table>
    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>'.$data['initial_psychi_551'].'Use Disorder, moderate, in post-acute withdrawal</p>
        </td>
      </tr>
    </table>

    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>{Mental Health} Disorder(s)</p>
        </td>
      </tr>
    </table>

    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>{Biomedical Condition(s)}</p>
        </td>
      </tr>
    </table>

    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>';
          if(isset($data['text5'])){
           $print.= $data['text5']; 
         } else{
             
            $print.='Starting {Level of Care} with:</p>
          <p>Clonidine B</p>
          <p>All PRN’s medications.</p>
          <p>Patient refused history and physical. Requested primary care for H&P/Labs. Discussed with the patient the dose, schedule, risk, and benefits of taking and not taking Clonidine B and all PRN’s. I have also discussed the potential interactions of the medication prescribed if combined with alcohol or non-prescription drugs, the potential heart related problems, the possibility of agitation, the possibility of falling, the possibility of suicidal thoughts and the risks related to pregnancy. The patient understood the discussion and consented to the treatment. A Medication Education Sheet was provided. A “No Loss” policy was discussed as was the need to choose one pharmacy for all meds. The Patient consented to a random “pill counts and toxicology screens.”
          Patient was educated regarding the risks versus benefits of {Level of Care}. Patient was also counseled on physiological symptoms of acute intoxication, withdrawal potential, biomedical conditions and complications, and emotional/behavioral/cognitive conditions. Psychosocial treatment components were elaborated on such as acceptance and resistance, relapse potential, recovery, environment and family/caregiver functioning that is offered during psychoeducational groups in CNT’S {Level of Care} program. Patient was advised to contact our nursing director after hours for all inquiries and concerns via the Center for Network Therapy answering service. While in {Level of Care}, any after hour emergency that are of an acute nature should be addressed by calling 911 or by going to your local emergency room. Patients are made aware that {Level of Care} level of care is an alternative to inpatient residential care. If the patient’s psychological/medical function reportedly has diminished, they will be referred to a higher level of care, which is residential inpatient.</p>'; } 
          $print.='
        </td>
      </tr>
    </table>

    <table style="width:100%; border: 1px solid black">
      <tr>
        <td style="width:100%; border: 1px solid black">
          <p>Signed Suboxone Tool Kit? <input type="checkbox" name="initial_psychi_552" value="1" '.$initial_psychi_552.'>N/A <input type="checkbox" name="initial_psychi_553" value="2" '.$initial_psychi_553.'>Yes <input type="checkbox" name="initial_psychi_554" value="3" '.$initial_psychi_554.'>No &emsp;&emsp;If no, why?  '.$data['no_explain'].'</p>
        </td>
      </tr>
    </table>

    <table style="width:100%; border: 1px solid black">
      <tr>
      <td style="50% text-align:center;">';
      if($data['initial_psychi_555']){
        $print.='<p><img src="data:image/png;base64,'.$data['initial_psychi_555'].'" width="100px" height="50px"></p>';
      }
        $print.='<p>M.D. Signature/ Degree</p>';
      if($data['initial_psychi_557']){
        $print.='
        <p><img src="data:image/png;base64,'.$data['initial_psychi_557'].'" width="100px" height="50px"></p>';
      }
      
      if(isset($data['text6'])){
       $print.= $data['text6']; 
     } else{
         
        $print.='
      <p>Daniel O’Connell, MSW, LSW, LCADC Intern</p>'; } 
      $print.='
    </td>
        <td style="50% text-align:center;">
          <p>'.$data['initial_psychi_556'].'</p>
          <p>Date/Time</p>
          <p>'.$data['initial_psychi_558'].'</p>
          <p>Date/Time</p>
        </td>
      </tr>
    </table>

        ';
    }
    else{
        $print="Not Found";
    }
    //  echo $print;
    //  exit;
$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($print);
$file='pdf/'.time().'.pdf';
$mpdf->Output($file,'I');

?>
