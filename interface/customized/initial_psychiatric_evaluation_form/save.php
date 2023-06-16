<?php

/**
 * Clinical instructions form save.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */
// echo 'test';
// exit;
require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");

$id = 0 + (isset($_GET['id']) ? $_GET['id'] : '');

$_POST['initial_psychi_7']= isset($_POST['initial_psychi_7'])?$_POST['initial_psychi_7']:' ';
$_POST['initial_psychi_8']= isset($_POST['initial_psychi_8'])?$_POST['initial_psychi_8']:' ';
$_POST['initial_psychi_9']= isset($_POST['initial_psychi_9'])?$_POST['initial_psychi_9']:' ';
$_POST['initial_psychi_10']= isset($_POST['initial_psychi_10'])?$_POST['initial_psychi_10']:' ';
$_POST['initial_psychi_11']= isset($_POST['initial_psychi_11'])?$_POST['initial_psychi_11']:' ';
$_POST['initial_psychi_12']= isset($_POST['initial_psychi_12'])?$_POST['initial_psychi_12']:' ';
$_POST['initial_psychi_41']= isset($_POST['initial_psychi_41'])?$_POST['initial_psychi_41']:' ';
$_POST['initial_psychi_42']= isset($_POST['initial_psychi_42'])?$_POST['initial_psychi_42']:' ';
$_POST['initial_psychi_43']= isset($_POST['initial_psychi_43'])?$_POST['initial_psychi_43']:' ';
$_POST['initial_psychi_44']= isset($_POST['initial_psychi_44'])?$_POST['initial_psychi_44']:' ';
$_POST['initial_psychi_45']= isset($_POST['initial_psychi_45'])?$_POST['initial_psychi_45']:' ';
$_POST['initial_psychi_46']= isset($_POST['initial_psychi_46'])?$_POST['initial_psychi_46']:' ';
$_POST['initial_psychi_47']= isset($_POST['initial_psychi_47'])?$_POST['initial_psychi_47']:' ';
$_POST['initial_psychi_48']= isset($_POST['initial_psychi_48'])?$_POST['initial_psychi_48']:' ';
$_POST['initial_psychi_49']= isset($_POST['initial_psychi_49'])?$_POST['initial_psychi_49']:' ';
$_POST['initial_psychi_50']= isset($_POST['initial_psychi_50'])?$_POST['initial_psychi_50']:' ';

$_POST['initial_psychi_51']= isset($_POST['initial_psychi_51'])?$_POST['initial_psychi_51']:' ';
$_POST['initial_psychi_52']= isset($_POST['initial_psychi_52'])?$_POST['initial_psychi_52']:' ';
$_POST['initial_psychi_53']= isset($_POST['initial_psychi_53'])?$_POST['initial_psychi_53']:' ';
$_POST['initial_psychi_54']= isset($_POST['initial_psychi_54'])?$_POST['initial_psychi_54']:' ';
$_POST['initial_psychi_55']= isset($_POST['initial_psychi_55'])?$_POST['initial_psychi_55']:' ';
$_POST['initial_psychi_56']= isset($_POST['initial_psychi_56'])?$_POST['initial_psychi_56']:' ';
$_POST['initial_psychi_57']= isset($_POST['initial_psychi_57'])?$_POST['initial_psychi_57']:' ';
$_POST['initial_psychi_58']= isset($_POST['initial_psychi_58'])?$_POST['initial_psychi_58']:' ';
$_POST['initial_psychi_59']= isset($_POST['initial_psychi_59'])?$_POST['initial_psychi_59']:' ';
$_POST['initial_psychi_60']= isset($_POST['initial_psychi_60'])?$_POST['initial_psychi_60']:' ';

$_POST['initial_psychi_61']= isset($_POST['initial_psychi_61'])?$_POST['initial_psychi_61']:' ';
$_POST['initial_psychi_62']= isset($_POST['initial_psychi_62'])?$_POST['initial_psychi_62']:' ';
$_POST['initial_psychi_63']= isset($_POST['initial_psychi_63'])?$_POST['initial_psychi_63']:' ';
$_POST['initial_psychi_64']= isset($_POST['initial_psychi_64'])?$_POST['initial_psychi_64']:' ';
$_POST['initial_psychi_65']= isset($_POST['initial_psychi_65'])?$_POST['initial_psychi_65']:' ';
$_POST['initial_psychi_66']= isset($_POST['initial_psychi_66'])?$_POST['initial_psychi_66']:' ';
$_POST['initial_psychi_67']= isset($_POST['initial_psychi_67'])?$_POST['initial_psychi_67']:' ';
$_POST['initial_psychi_68']= isset($_POST['initial_psychi_68'])?$_POST['initial_psychi_68']:' ';
$_POST['initial_psychi_69']= isset($_POST['initial_psychi_69'])?$_POST['initial_psychi_69']:' ';

$_POST['initial_psychi_70']= isset($_POST['initial_psychi_70'])?$_POST['initial_psychi_70']:' ';
$_POST['initial_psychi_71']= isset($_POST['initial_psychi_71'])?$_POST['initial_psychi_71']:' ';
$_POST['initial_psychi_72']= isset($_POST['initial_psychi_72'])?$_POST['initial_psychi_72']:' ';
$_POST['initial_psychi_73']= isset($_POST['initial_psychi_73'])?$_POST['initial_psychi_73']:' ';
$_POST['initial_psychi_74']= isset($_POST['initial_psychi_74'])?$_POST['initial_psychi_74']:' ';
$_POST['initial_psychi_75']= isset($_POST['initial_psychi_75'])?$_POST['initial_psychi_75']:' ';
$_POST['initial_psychi_76']= isset($_POST['initial_psychi_76'])?$_POST['initial_psychi_76']:' ';
$_POST['initial_psychi_77']= isset($_POST['initial_psychi_77'])?$_POST['initial_psychi_77']:' ';
$_POST['initial_psychi_78']= isset($_POST['initial_psychi_78'])?$_POST['initial_psychi_78']:' ';
$_POST['initial_psychi_79']= isset($_POST['initial_psychi_79'])?$_POST['initial_psychi_79']:' ';

$_POST['initial_psychi_80']= isset($_POST['initial_psychi_80'])?$_POST['initial_psychi_80']:' ';
$_POST['initial_psychi_81']= isset($_POST['initial_psychi_81'])?$_POST['initial_psychi_81']:' ';
$_POST['initial_psychi_82']= isset($_POST['initial_psychi_82'])?$_POST['initial_psychi_82']:' ';
$_POST['initial_psychi_83']= isset($_POST['initial_psychi_83'])?$_POST['initial_psychi_83']:' ';
$_POST['initial_psychi_84']= isset($_POST['initial_psychi_84'])?$_POST['initial_psychi_84']:' ';
$_POST['initial_psychi_85']= isset($_POST['initial_psychi_85'])?$_POST['initial_psychi_85']:' ';
$_POST['initial_psychi_86']= isset($_POST['initial_psychi_86'])?$_POST['initial_psychi_86']:' ';
$_POST['initial_psychi_87']= isset($_POST['initial_psychi_87'])?$_POST['initial_psychi_87']:' ';
$_POST['initial_psychi_88']= isset($_POST['initial_psychi_88'])?$_POST['initial_psychi_88']:' ';
$_POST['initial_psychi_89']= isset($_POST['initial_psychi_89'])?$_POST['initial_psychi_89']:' ';

$_POST['initial_psychi_90']= isset($_POST['initial_psychi_90'])?$_POST['initial_psychi_90']:' ';
$_POST['initial_psychi_91']= isset($_POST['initial_psychi_91'])?$_POST['initial_psychi_91']:' ';
$_POST['initial_psychi_92']= isset($_POST['initial_psychi_92'])?$_POST['initial_psychi_92']:' ';
$_POST['initial_psychi_93']= isset($_POST['initial_psychi_93'])?$_POST['initial_psychi_93']:' ';
$_POST['initial_psychi_94']= isset($_POST['initial_psychi_94'])?$_POST['initial_psychi_94']:' ';
$_POST['initial_psychi_95']= isset($_POST['initial_psychi_95'])?$_POST['initial_psychi_95']:' ';
$_POST['initial_psychi_96']= isset($_POST['initial_psychi_96'])?$_POST['initial_psychi_96']:' ';
$_POST['initial_psychi_97']= isset($_POST['initial_psychi_97'])?$_POST['initial_psychi_97']:' ';
$_POST['initial_psychi_98']= isset($_POST['initial_psychi_98'])?$_POST['initial_psychi_98']:' ';
$_POST['initial_psychi_99']= isset($_POST['initial_psychi_99'])?$_POST['initial_psychi_99']:' ';

$_POST['initial_psychi_100']= isset($_POST['initial_psychi_100'])?$_POST['initial_psychi_100']:' ';
$_POST['initial_psychi_101']= isset($_POST['initial_psychi_101'])?$_POST['initial_psychi_101']:' ';
$_POST['initial_psychi_102']= isset($_POST['initial_psychi_102'])?$_POST['initial_psychi_102']:' ';
$_POST['initial_psychi_103']= isset($_POST['initial_psychi_103'])?$_POST['initial_psychi_103']:' ';
$_POST['initial_psychi_104']= isset($_POST['initial_psychi_104'])?$_POST['initial_psychi_104']:' ';
$_POST['initial_psychi_105']= isset($_POST['initial_psychi_105'])?$_POST['initial_psychi_105']:' ';
$_POST['initial_psychi_106']= isset($_POST['initial_psychi_106'])?$_POST['initial_psychi_106']:' ';
$_POST['initial_psychi_107']= isset($_POST['initial_psychi_107'])?$_POST['initial_psychi_107']:' ';
$_POST['initial_psychi_108']= isset($_POST['initial_psychi_108'])?$_POST['initial_psychi_108']:' ';
$_POST['initial_psychi_109']= isset($_POST['initial_psychi_109'])?$_POST['initial_psychi_109']:' ';

$_POST['initial_psychi_110']= isset($_POST['initial_psychi_110'])?$_POST['initial_psychi_110']:' ';
$_POST['initial_psychi_111']= isset($_POST['initial_psychi_111'])?$_POST['initial_psychi_111']:' ';
$_POST['initial_psychi_112']= isset($_POST['initial_psychi_112'])?$_POST['initial_psychi_112']:' ';
$_POST['initial_psychi_113']= isset($_POST['initial_psychi_113'])?$_POST['initial_psychi_113']:' ';
$_POST['initial_psychi_114']= isset($_POST['initial_psychi_114'])?$_POST['initial_psychi_114']:' ';
$_POST['initial_psychi_115']= isset($_POST['initial_psychi_115'])?$_POST['initial_psychi_115']:' ';
$_POST['initial_psychi_116']= isset($_POST['initial_psychi_116'])?$_POST['initial_psychi_116']:' ';
$_POST['initial_psychi_117']= isset($_POST['initial_psychi_117'])?$_POST['initial_psychi_117']:' ';
$_POST['initial_psychi_118']= isset($_POST['initial_psychi_118'])?$_POST['initial_psychi_118']:' ';

$_POST['initial_psychi_134']= isset($_POST['initial_psychi_134'])?$_POST['initial_psychi_134']:' ';
$_POST['initial_psychi_139']= isset($_POST['initial_psychi_139'])?$_POST['initial_psychi_139']:' ';
$_POST['initial_psychi_140']= isset($_POST['initial_psychi_140'])?$_POST['initial_psychi_140']:' ';
$_POST['initial_psychi_141']= isset($_POST['initial_psychi_141'])?$_POST['initial_psychi_141']:' ';
$_POST['initial_psychi_142']= isset($_POST['initial_psychi_142'])?$_POST['initial_psychi_142']:' ';
$_POST['initial_psychi_144']= isset($_POST['initial_psychi_144'])?$_POST['initial_psychi_144']:' ';
$_POST['initial_psychi_146']= isset($_POST['initial_psychi_146'])?$_POST['initial_psychi_146']:' ';
$_POST['initial_psychi_148']= isset($_POST['initial_psychi_148'])?$_POST['initial_psychi_148']:' ';
$_POST['initial_psychi_150']= isset($_POST['initial_psychi_150'])?$_POST['initial_psychi_150']:' ';
$_POST['initial_psychi_152']= isset($_POST['initial_psychi_152'])?$_POST['initial_psychi_152']:' ';
$_POST['initial_psychi_154']= isset($_POST['initial_psychi_154'])?$_POST['initial_psychi_154']:' ';
$_POST['initial_psychi_156']= isset($_POST['initial_psychi_156'])?$_POST['initial_psychi_156']:' ';
$_POST['initial_psychi_164']= isset($_POST['initial_psychi_164'])?$_POST['initial_psychi_164']:' ';
$_POST['initial_psychi_165']= isset($_POST['initial_psychi_165'])?$_POST['initial_psychi_165']:' ';
$_POST['initial_psychi_166']= isset($_POST['initial_psychi_166'])?$_POST['initial_psychi_166']:' ';
$_POST['initial_psychi_167']= isset($_POST['initial_psychi_167'])?$_POST['initial_psychi_167']:' ';
$_POST['initial_psychi_168']= isset($_POST['initial_psychi_168'])?$_POST['initial_psychi_168']:' ';
$_POST['initial_psychi_175']= isset($_POST['initial_psychi_175'])?$_POST['initial_psychi_175']:' ';

$_POST['initial_psychi_188']= isset($_POST['initial_psychi_188'])?$_POST['initial_psychi_188']:' ';
$_POST['initial_psychi_559']= isset($_POST['initial_psychi_559'])?$_POST['initial_psychi_559']:' ';
$_POST['initial_psychi_560']= isset($_POST['initial_psychi_560'])?$_POST['initial_psychi_560']:' ';
$_POST['initial_psychi_200']= isset($_POST['initial_psychi_200'])?$_POST['initial_psychi_200']:' ';
$_POST['initial_psychi_561']= isset($_POST['initial_psychi_561'])?$_POST['initial_psychi_561']:' ';
$_POST['initial_psychi_562']= isset($_POST['initial_psychi_562'])?$_POST['initial_psychi_562']:' ';
$_POST['initial_psychi_212']= isset($_POST['initial_psychi_212'])?$_POST['initial_psychi_212']:' ';
$_POST['initial_psychi_563']= isset($_POST['initial_psychi_563'])?$_POST['initial_psychi_563']:' ';
$_POST['initial_psychi_564']= isset($_POST['initial_psychi_564'])?$_POST['initial_psychi_564']:' ';
$_POST['initial_psychi_224']= isset($_POST['initial_psychi_224'])?$_POST['initial_psychi_224']:' ';
$_POST['initial_psychi_226']= isset($_POST['initial_psychi_226'])?$_POST['initial_psychi_226']:' ';
$_POST['initial_psychi_565']= isset($_POST['initial_psychi_565'])?$_POST['initial_psychi_565']:' ';
$_POST['initial_psychi_566']= isset($_POST['initial_psychi_566'])?$_POST['initial_psychi_566']:' ';
$_POST['initial_psychi_233']= isset($_POST['initial_psychi_233'])?$_POST['initial_psychi_233']:' ';

$_POST['initial_psychi_567']= isset($_POST['initial_psychi_567'])?$_POST['initial_psychi_567']:' ';
$_POST['initial_psychi_568']= isset($_POST['initial_psychi_568'])?$_POST['initial_psychi_568']:' ';
$_POST['initial_psychi_246']= isset($_POST['initial_psychi_246'])?$_POST['initial_psychi_246']:' ';
$_POST['initial_psychi_247']= isset($_POST['initial_psychi_247'])?$_POST['initial_psychi_247']:' ';
$_POST['initial_psychi_251']= isset($_POST['initial_psychi_251'])?$_POST['initial_psychi_251']:' ';
$_POST['initial_psychi_260']= isset($_POST['initial_psychi_260'])?$_POST['initial_psychi_260']:' ';
$_POST['initial_psychi_261']= isset($_POST['initial_psychi_261'])?$_POST['initial_psychi_261']:' ';
$_POST['initial_psychi_264']= isset($_POST['initial_psychi_264'])?$_POST['initial_psychi_264']:' ';
$_POST['initial_psychi_267']= isset($_POST['initial_psychi_267'])?$_POST['initial_psychi_267']:' ';
$_POST['initial_psychi_270']= isset($_POST['initial_psychi_270'])?$_POST['initial_psychi_270']:' ';
$_POST['initial_psychi_273']= isset($_POST['initial_psychi_273'])?$_POST['initial_psychi_273']:' ';
$_POST['initial_psychi_276']= isset($_POST['initial_psychi_276'])?$_POST['initial_psychi_276']:' ';
$_POST['initial_psychi_277']= isset($_POST['initial_psychi_277'])?$_POST['initial_psychi_277']:' ';

$_POST['initial_psychi_278']= isset($_POST['initial_psychi_278'])?$_POST['initial_psychi_278']:' ';
$_POST['initial_psychi_279']= isset($_POST['initial_psychi_279'])?$_POST['initial_psychi_279']:' ';
$_POST['initial_psychi_280']= isset($_POST['initial_psychi_280'])?$_POST['initial_psychi_280']:' ';
$_POST['initial_psychi_570']= isset($_POST['initial_psychi_570'])?$_POST['initial_psychi_570']:' ';

$_POST['initial_psychi_281']= isset($_POST['initial_psychi_281'])?$_POST['initial_psychi_281']:' ';
$_POST['initial_psychi_282']= isset($_POST['initial_psychi_282'])?$_POST['initial_psychi_282']:' ';
$_POST['initial_psychi_283']= isset($_POST['initial_psychi_283'])?$_POST['initial_psychi_283']:' ';
$_POST['initial_psychi_284']= isset($_POST['initial_psychi_284'])?$_POST['initial_psychi_284']:' ';
$_POST['initial_psychi_285']= isset($_POST['initial_psychi_285'])?$_POST['initial_psychi_285']:' ';
$_POST['initial_psychi_286']= isset($_POST['initial_psychi_286'])?$_POST['initial_psychi_286']:' ';
$_POST['initial_psychi_287']= isset($_POST['initial_psychi_287'])?$_POST['initial_psychi_287']:' ';
$_POST['initial_psychi_288']= isset($_POST['initial_psychi_288'])?$_POST['initial_psychi_288']:' ';
$_POST['initial_psychi_289']= isset($_POST['initial_psychi_289'])?$_POST['initial_psychi_289']:' ';

$_POST['initial_psychi_290']= isset($_POST['initial_psychi_290'])?$_POST['initial_psychi_290']:' ';
$_POST['initial_psychi_291']= isset($_POST['initial_psychi_291'])?$_POST['initial_psychi_291']:' ';
$_POST['initial_psychi_292']= isset($_POST['initial_psychi_292'])?$_POST['initial_psychi_292']:' ';
$_POST['initial_psychi_293']= isset($_POST['initial_psychi_293'])?$_POST['initial_psychi_293']:' ';
$_POST['initial_psychi_294']= isset($_POST['initial_psychi_294'])?$_POST['initial_psychi_294']:' ';
$_POST['initial_psychi_295']= isset($_POST['initial_psychi_295'])?$_POST['initial_psychi_295']:' ';
$_POST['initial_psychi_296']= isset($_POST['initial_psychi_296'])?$_POST['initial_psychi_296']:' ';
$_POST['initial_psychi_297']= isset($_POST['initial_psychi_297'])?$_POST['initial_psychi_297']:' ';
$_POST['initial_psychi_298']= isset($_POST['initial_psychi_298'])?$_POST['initial_psychi_298']:' ';
$_POST['initial_psychi_299']= isset($_POST['initial_psychi_299'])?$_POST['initial_psychi_299']:' ';

$_POST['initial_psychi_300']= isset($_POST['initial_psychi_300'])?$_POST['initial_psychi_300']:' ';
$_POST['initial_psychi_301']= isset($_POST['initial_psychi_301'])?$_POST['initial_psychi_301']:' ';
$_POST['initial_psychi_302']= isset($_POST['initial_psychi_302'])?$_POST['initial_psychi_302']:' ';
$_POST['initial_psychi_303']= isset($_POST['initial_psychi_303'])?$_POST['initial_psychi_303']:' ';
$_POST['initial_psychi_307']= isset($_POST['initial_psychi_307'])?$_POST['initial_psychi_307']:' ';
$_POST['initial_psychi_308']= isset($_POST['initial_psychi_308'])?$_POST['initial_psychi_308']:' ';
$_POST['initial_psychi_309']= isset($_POST['initial_psychi_309'])?$_POST['initial_psychi_309']:' ';

$_POST['initial_psychi_310']= isset($_POST['initial_psychi_310'])?$_POST['initial_psychi_310']:' ';
$_POST['initial_psychi_311']= isset($_POST['initial_psychi_311'])?$_POST['initial_psychi_311']:' ';
$_POST['initial_psychi_312']= isset($_POST['initial_psychi_312'])?$_POST['initial_psychi_312']:' ';
$_POST['initial_psychi_313']= isset($_POST['initial_psychi_313'])?$_POST['initial_psychi_313']:' ';
$_POST['initial_psychi_315']= isset($_POST['initial_psychi_315'])?$_POST['initial_psychi_315']:' ';
$_POST['initial_psychi_316']= isset($_POST['initial_psychi_316'])?$_POST['initial_psychi_316']:' ';
$_POST['initial_psychi_318']= isset($_POST['initial_psychi_318'])?$_POST['initial_psychi_318']:' ';
$_POST['initial_psychi_319']= isset($_POST['initial_psychi_319'])?$_POST['initial_psychi_319']:' ';

$_POST['initial_psychi_320']= isset($_POST['initial_psychi_320'])?$_POST['initial_psychi_320']:' ';
$_POST['initial_psychi_322']= isset($_POST['initial_psychi_322'])?$_POST['initial_psychi_322']:' ';
$_POST['initial_psychi_323']= isset($_POST['initial_psychi_323'])?$_POST['initial_psychi_323']:' ';
$_POST['initial_psychi_324']= isset($_POST['initial_psychi_324'])?$_POST['initial_psychi_324']:' ';
$_POST['initial_psychi_325']= isset($_POST['initial_psychi_325'])?$_POST['initial_psychi_325']:' ';
$_POST['initial_psychi_326']= isset($_POST['initial_psychi_326'])?$_POST['initial_psychi_326']:' ';
$_POST['initial_psychi_328']= isset($_POST['initial_psychi_328'])?$_POST['initial_psychi_328']:' ';

$_POST['initial_psychi_331']= isset($_POST['initial_psychi_331'])?$_POST['initial_psychi_331']:' ';
$_POST['initial_psychi_332']= isset($_POST['initial_psychi_332'])?$_POST['initial_psychi_332']:' ';
$_POST['initial_psychi_333']= isset($_POST['initial_psychi_333'])?$_POST['initial_psychi_333']:' ';
$_POST['initial_psychi_334']= isset($_POST['initial_psychi_334'])?$_POST['initial_psychi_334']:' ';
$_POST['initial_psychi_335']= isset($_POST['initial_psychi_335'])?$_POST['initial_psychi_335']:' ';
$_POST['initial_psychi_336']= isset($_POST['initial_psychi_336'])?$_POST['initial_psychi_336']:' ';
$_POST['initial_psychi_337']= isset($_POST['initial_psychi_337'])?$_POST['initial_psychi_337']:' ';
$_POST['initial_psychi_338']= isset($_POST['initial_psychi_338'])?$_POST['initial_psychi_338']:' ';
$_POST['initial_psychi_339']= isset($_POST['initial_psychi_339'])?$_POST['initial_psychi_339']:' ';

$_POST['initial_psychi_340']= isset($_POST['initial_psychi_340'])?$_POST['initial_psychi_340']:' ';
$_POST['initial_psychi_342']= isset($_POST['initial_psychi_342'])?$_POST['initial_psychi_342']:' ';
$_POST['initial_psychi_344']= isset($_POST['initial_psychi_344'])?$_POST['initial_psychi_344']:' ';
$_POST['initial_psychi_351']= isset($_POST['initial_psychi_351'])?$_POST['initial_psychi_351']:' ';
$_POST['initial_psychi_358']= isset($_POST['initial_psychi_358'])?$_POST['initial_psychi_358']:' ';
$_POST['initial_psychi_359']= isset($_POST['initial_psychi_359'])?$_POST['initial_psychi_359']:' ';

$_POST['initial_psychi_360']= isset($_POST['initial_psychi_360'])?$_POST['initial_psychi_360']:' ';
$_POST['initial_psychi_361']= isset($_POST['initial_psychi_361'])?$_POST['initial_psychi_361']:' ';
$_POST['initial_psychi_362']= isset($_POST['initial_psychi_362'])?$_POST['initial_psychi_362']:' ';
$_POST['initial_psychi_363']= isset($_POST['initial_psychi_363'])?$_POST['initial_psychi_363']:' ';
$_POST['initial_psychi_364']= isset($_POST['initial_psychi_364'])?$_POST['initial_psychi_364']:' ';
$_POST['initial_psychi_365']= isset($_POST['initial_psychi_365'])?$_POST['initial_psychi_365']:' ';
$_POST['initial_psychi_366']= isset($_POST['initial_psychi_366'])?$_POST['initial_psychi_366']:' ';
$_POST['initial_psychi_367']= isset($_POST['initial_psychi_367'])?$_POST['initial_psychi_367']:' ';
$_POST['initial_psychi_368']= isset($_POST['initial_psychi_368'])?$_POST['initial_psychi_368']:' ';
$_POST['initial_psychi_369']= isset($_POST['initial_psychi_369'])?$_POST['initial_psychi_369']:' ';

$_POST['initial_psychi_370']= isset($_POST['initial_psychi_370'])?$_POST['initial_psychi_370']:' ';
$_POST['initial_psychi_371']= isset($_POST['initial_psychi_371'])?$_POST['initial_psychi_371']:' ';
$_POST['initial_psychi_372']= isset($_POST['initial_psychi_372'])?$_POST['initial_psychi_372']:' ';
$_POST['initial_psychi_373']= isset($_POST['initial_psychi_373'])?$_POST['initial_psychi_373']:' ';
$_POST['initial_psychi_374']= isset($_POST['initial_psychi_374'])?$_POST['initial_psychi_374']:' ';
$_POST['initial_psychi_375']= isset($_POST['initial_psychi_375'])?$_POST['initial_psychi_375']:' ';
$_POST['initial_psychi_376']= isset($_POST['initial_psychi_376'])?$_POST['initial_psychi_376']:' ';
$_POST['initial_psychi_377']= isset($_POST['initial_psychi_377'])?$_POST['initial_psychi_377']:' ';
$_POST['initial_psychi_378']= isset($_POST['initial_psychi_378'])?$_POST['initial_psychi_378']:' ';
$_POST['initial_psychi_379']= isset($_POST['initial_psychi_379'])?$_POST['initial_psychi_379']:' ';

$_POST['initial_psychi_380']= isset($_POST['initial_psychi_380'])?$_POST['initial_psychi_380']:' ';
$_POST['initial_psychi_381']= isset($_POST['initial_psychi_381'])?$_POST['initial_psychi_381']:' ';
$_POST['initial_psychi_382']= isset($_POST['initial_psychi_382'])?$_POST['initial_psychi_382']:' ';
$_POST['initial_psychi_385']= isset($_POST['initial_psychi_385'])?$_POST['initial_psychi_385']:' ';
$_POST['initial_psychi_386']= isset($_POST['initial_psychi_386'])?$_POST['initial_psychi_386']:' ';
$_POST['initial_psychi_387']= isset($_POST['initial_psychi_387'])?$_POST['initial_psychi_387']:' ';
$_POST['initial_psychi_388']= isset($_POST['initial_psychi_388'])?$_POST['initial_psychi_388']:' ';
$_POST['initial_psychi_389']= isset($_POST['initial_psychi_389'])?$_POST['initial_psychi_389']:' ';

$_POST['initial_psychi_390']= isset($_POST['initial_psychi_390'])?$_POST['initial_psychi_390']:' ';
$_POST['initial_psychi_391']= isset($_POST['initial_psychi_391'])?$_POST['initial_psychi_391']:' ';
$_POST['initial_psychi_392']= isset($_POST['initial_psychi_392'])?$_POST['initial_psychi_392']:' ';
$_POST['initial_psychi_393']= isset($_POST['initial_psychi_393'])?$_POST['initial_psychi_393']:' ';
$_POST['initial_psychi_394']= isset($_POST['initial_psychi_394'])?$_POST['initial_psychi_394']:' ';
$_POST['initial_psychi_395']= isset($_POST['initial_psychi_395'])?$_POST['initial_psychi_395']:' ';
$_POST['initial_psychi_396']= isset($_POST['initial_psychi_396'])?$_POST['initial_psychi_396']:' ';
$_POST['initial_psychi_397']= isset($_POST['initial_psychi_397'])?$_POST['initial_psychi_397']:' ';
$_POST['initial_psychi_398']= isset($_POST['initial_psychi_398'])?$_POST['initial_psychi_398']:' ';
$_POST['initial_psychi_399']= isset($_POST['initial_psychi_399'])?$_POST['initial_psychi_399']:' ';

$_POST['initial_psychi_400']= isset($_POST['initial_psychi_400'])?$_POST['initial_psychi_400']:' ';
$_POST['initial_psychi_401']= isset($_POST['initial_psychi_401'])?$_POST['initial_psychi_401']:' ';
$_POST['initial_psychi_402']= isset($_POST['initial_psychi_402'])?$_POST['initial_psychi_402']:' ';
$_POST['initial_psychi_403']= isset($_POST['initial_psychi_403'])?$_POST['initial_psychi_403']:' ';
$_POST['initial_psychi_404']= isset($_POST['initial_psychi_404'])?$_POST['initial_psychi_404']:' ';
$_POST['initial_psychi_405']= isset($_POST['initial_psychi_405'])?$_POST['initial_psychi_405']:' ';
$_POST['initial_psychi_406']= isset($_POST['initial_psychi_406'])?$_POST['initial_psychi_406']:' ';
$_POST['initial_psychi_407']= isset($_POST['initial_psychi_407'])?$_POST['initial_psychi_407']:' ';
$_POST['initial_psychi_409']= isset($_POST['initial_psychi_409'])?$_POST['initial_psychi_409']:' ';

$_POST['initial_psychi_410']= isset($_POST['initial_psychi_410'])?$_POST['initial_psychi_410']:' ';
$_POST['initial_psychi_411']= isset($_POST['initial_psychi_411'])?$_POST['initial_psychi_411']:' ';
$_POST['initial_psychi_412']= isset($_POST['initial_psychi_412'])?$_POST['initial_psychi_412']:' ';
$_POST['initial_psychi_413']= isset($_POST['initial_psychi_413'])?$_POST['initial_psychi_413']:' ';
$_POST['initial_psychi_414']= isset($_POST['initial_psychi_414'])?$_POST['initial_psychi_414']:' ';
$_POST['initial_psychi_415']= isset($_POST['initial_psychi_415'])?$_POST['initial_psychi_415']:' ';
$_POST['initial_psychi_416']= isset($_POST['initial_psychi_416'])?$_POST['initial_psychi_416']:' ';
$_POST['initial_psychi_417']= isset($_POST['initial_psychi_417'])?$_POST['initial_psychi_417']:' ';
$_POST['initial_psychi_418']= isset($_POST['initial_psychi_418'])?$_POST['initial_psychi_418']:' ';
$_POST['initial_psychi_419']= isset($_POST['initial_psychi_419'])?$_POST['initial_psychi_419']:' ';

$_POST['initial_psychi_420']= isset($_POST['initial_psychi_420'])?$_POST['initial_psychi_420']:' ';
$_POST['initial_psychi_421']= isset($_POST['initial_psychi_421'])?$_POST['initial_psychi_421']:' ';
$_POST['initial_psychi_422']= isset($_POST['initial_psychi_422'])?$_POST['initial_psychi_422']:' ';
$_POST['initial_psychi_424']= isset($_POST['initial_psychi_424'])?$_POST['initial_psychi_424']:' ';
$_POST['initial_psychi_425']= isset($_POST['initial_psychi_425'])?$_POST['initial_psychi_425']:' ';
$_POST['initial_psychi_426']= isset($_POST['initial_psychi_426'])?$_POST['initial_psychi_426']:' ';
$_POST['initial_psychi_427']= isset($_POST['initial_psychi_427'])?$_POST['initial_psychi_427']:' ';

$_POST['initial_psychi_430']= isset($_POST['initial_psychi_430'])?$_POST['initial_psychi_430']:' ';
$_POST['initial_psychi_431']= isset($_POST['initial_psychi_431'])?$_POST['initial_psychi_431']:' ';
$_POST['initial_psychi_432']= isset($_POST['initial_psychi_432'])?$_POST['initial_psychi_432']:' ';
$_POST['initial_psychi_433']= isset($_POST['initial_psychi_433'])?$_POST['initial_psychi_433']:' ';
$_POST['initial_psychi_434']= isset($_POST['initial_psychi_434'])?$_POST['initial_psychi_434']:' ';
$_POST['initial_psychi_435']= isset($_POST['initial_psychi_435'])?$_POST['initial_psychi_435']:' ';
$_POST['initial_psychi_436']= isset($_POST['initial_psychi_436'])?$_POST['initial_psychi_436']:' ';
$_POST['initial_psychi_437']= isset($_POST['initial_psychi_437'])?$_POST['initial_psychi_437']:' ';
$_POST['initial_psychi_438']= isset($_POST['initial_psychi_438'])?$_POST['initial_psychi_438']:' ';
$_POST['initial_psychi_439']= isset($_POST['initial_psychi_439'])?$_POST['initial_psychi_439']:' ';

$_POST['initial_psychi_440']= isset($_POST['initial_psychi_440'])?$_POST['initial_psychi_440']:' ';
$_POST['initial_psychi_441']= isset($_POST['initial_psychi_441'])?$_POST['initial_psychi_441']:' ';
$_POST['initial_psychi_442']= isset($_POST['initial_psychi_442'])?$_POST['initial_psychi_442']:' ';
$_POST['initial_psychi_443']= isset($_POST['initial_psychi_443'])?$_POST['initial_psychi_443']:' ';
$_POST['initial_psychi_444']= isset($_POST['initial_psychi_444'])?$_POST['initial_psychi_444']:' ';
$_POST['initial_psychi_445']= isset($_POST['initial_psychi_445'])?$_POST['initial_psychi_445']:' ';
$_POST['initial_psychi_447']= isset($_POST['initial_psychi_447'])?$_POST['initial_psychi_447']:' ';
$_POST['initial_psychi_448']= isset($_POST['initial_psychi_448'])?$_POST['initial_psychi_448']:' ';
$_POST['initial_psychi_449']= isset($_POST['initial_psychi_449'])?$_POST['initial_psychi_449']:' ';

$_POST['initial_psychi_450']= isset($_POST['initial_psychi_450'])?$_POST['initial_psychi_450']:' ';
$_POST['initial_psychi_451']= isset($_POST['initial_psychi_451'])?$_POST['initial_psychi_451']:' ';
$_POST['initial_psychi_452']= isset($_POST['initial_psychi_452'])?$_POST['initial_psychi_452']:' ';
$_POST['initial_psychi_453']= isset($_POST['initial_psychi_453'])?$_POST['initial_psychi_453']:' ';
$_POST['initial_psychi_455']= isset($_POST['initial_psychi_455'])?$_POST['initial_psychi_455']:' ';
$_POST['initial_psychi_456']= isset($_POST['initial_psychi_456'])?$_POST['initial_psychi_456']:' ';
$_POST['initial_psychi_457']= isset($_POST['initial_psychi_457'])?$_POST['initial_psychi_457']:' ';
$_POST['initial_psychi_458']= isset($_POST['initial_psychi_458'])?$_POST['initial_psychi_458']:' ';
$_POST['initial_psychi_459']= isset($_POST['initial_psychi_459'])?$_POST['initial_psychi_459']:' ';

$_POST['initial_psychi_460']= isset($_POST['initial_psychi_460'])?$_POST['initial_psychi_460']:' ';
$_POST['initial_psychi_461']= isset($_POST['initial_psychi_461'])?$_POST['initial_psychi_461']:' ';
$_POST['initial_psychi_462']= isset($_POST['initial_psychi_462'])?$_POST['initial_psychi_462']:' ';
$_POST['initial_psychi_463']= isset($_POST['initial_psychi_463'])?$_POST['initial_psychi_463']:' ';
$_POST['initial_psychi_465']= isset($_POST['initial_psychi_465'])?$_POST['initial_psychi_465']:' ';
$_POST['initial_psychi_466']= isset($_POST['initial_psychi_466'])?$_POST['initial_psychi_466']:' ';
$_POST['initial_psychi_467']= isset($_POST['initial_psychi_467'])?$_POST['initial_psychi_467']:' ';
$_POST['initial_psychi_468']= isset($_POST['initial_psychi_468'])?$_POST['initial_psychi_468']:' ';
$_POST['initial_psychi_469']= isset($_POST['initial_psychi_469'])?$_POST['initial_psychi_469']:' ';

$_POST['initial_psychi_470']= isset($_POST['initial_psychi_470'])?$_POST['initial_psychi_470']:' ';
$_POST['initial_psychi_471']= isset($_POST['initial_psychi_471'])?$_POST['initial_psychi_471']:' ';
$_POST['initial_psychi_472']= isset($_POST['initial_psychi_472'])?$_POST['initial_psychi_472']:' ';
$_POST['initial_psychi_473']= isset($_POST['initial_psychi_473'])?$_POST['initial_psychi_473']:' ';
$_POST['initial_psychi_475']= isset($_POST['initial_psychi_475'])?$_POST['initial_psychi_475']:' ';
$_POST['initial_psychi_476']= isset($_POST['initial_psychi_476'])?$_POST['initial_psychi_476']:' ';
$_POST['initial_psychi_478']= isset($_POST['initial_psychi_478'])?$_POST['initial_psychi_478']:' ';
$_POST['initial_psychi_479']= isset($_POST['initial_psychi_479'])?$_POST['initial_psychi_479']:' ';

$_POST['initial_psychi_481']= isset($_POST['initial_psychi_481'])?$_POST['initial_psychi_481']:' ';
$_POST['initial_psychi_482']= isset($_POST['initial_psychi_482'])?$_POST['initial_psychi_482']:' ';
$_POST['initial_psychi_483']= isset($_POST['initial_psychi_483'])?$_POST['initial_psychi_483']:' ';
$_POST['initial_psychi_484']= isset($_POST['initial_psychi_484'])?$_POST['initial_psychi_484']:' ';
$_POST['initial_psychi_485']= isset($_POST['initial_psychi_485'])?$_POST['initial_psychi_485']:' ';
$_POST['initial_psychi_486']= isset($_POST['initial_psychi_486'])?$_POST['initial_psychi_486']:' ';
$_POST['initial_psychi_487']= isset($_POST['initial_psychi_487'])?$_POST['initial_psychi_487']:' ';
$_POST['initial_psychi_488']= isset($_POST['initial_psychi_488'])?$_POST['initial_psychi_488']:' ';

$_POST['initial_psychi_490']= isset($_POST['initial_psychi_490'])?$_POST['initial_psychi_490']:' ';
$_POST['initial_psychi_491']= isset($_POST['initial_psychi_491'])?$_POST['initial_psychi_491']:' ';
$_POST['initial_psychi_492']= isset($_POST['initial_psychi_492'])?$_POST['initial_psychi_492']:' ';
$_POST['initial_psychi_493']= isset($_POST['initial_psychi_493'])?$_POST['initial_psychi_493']:' ';
$_POST['initial_psychi_495']= isset($_POST['initial_psychi_495'])?$_POST['initial_psychi_495']:' ';
$_POST['initial_psychi_496']= isset($_POST['initial_psychi_496'])?$_POST['initial_psychi_496']:' ';
$_POST['initial_psychi_498']= isset($_POST['initial_psychi_498'])?$_POST['initial_psychi_498']:' ';
$_POST['initial_psychi_499']= isset($_POST['initial_psychi_499'])?$_POST['initial_psychi_499']:' ';


$_POST['initial_psychi_500']= isset($_POST['initial_psychi_500'])?$_POST['initial_psychi_500']:' ';
$_POST['initial_psychi_501']= isset($_POST['initial_psychi_501'])?$_POST['initial_psychi_501']:' ';
$_POST['initial_psychi_502']= isset($_POST['initial_psychi_502'])?$_POST['initial_psychi_502']:' ';
$_POST['initial_psychi_504']= isset($_POST['initial_psychi_504'])?$_POST['initial_psychi_504']:' ';
$_POST['initial_psychi_505']= isset($_POST['initial_psychi_505'])?$_POST['initial_psychi_505']:' ';
$_POST['initial_psychi_506']= isset($_POST['initial_psychi_506'])?$_POST['initial_psychi_506']:' ';
$_POST['initial_psychi_508']= isset($_POST['initial_psychi_508'])?$_POST['initial_psychi_508']:' ';
$_POST['initial_psychi_509']= isset($_POST['initial_psychi_509'])?$_POST['initial_psychi_509']:' ';

$_POST['initial_psychi_511']= isset($_POST['initial_psychi_511'])?$_POST['initial_psychi_511']:' ';
$_POST['initial_psychi_512']= isset($_POST['initial_psychi_512'])?$_POST['initial_psychi_512']:' ';
$_POST['initial_psychi_514']= isset($_POST['initial_psychi_514'])?$_POST['initial_psychi_514']:' ';
$_POST['initial_psychi_515']= isset($_POST['initial_psychi_515'])?$_POST['initial_psychi_515']:' ';
$_POST['initial_psychi_517']= isset($_POST['initial_psychi_517'])?$_POST['initial_psychi_517']:' ';
$_POST['initial_psychi_518']= isset($_POST['initial_psychi_518'])?$_POST['initial_psychi_518']:' ';
$_POST['initial_psychi_519']= isset($_POST['initial_psychi_519'])?$_POST['initial_psychi_519']:' ';


$_POST['initial_psychi_520']= isset($_POST['initial_psychi_520'])?$_POST['initial_psychi_520']:' ';
$_POST['initial_psychi_521']= isset($_POST['initial_psychi_521'])?$_POST['initial_psychi_521']:' ';
$_POST['initial_psychi_522']= isset($_POST['initial_psychi_522'])?$_POST['initial_psychi_522']:' ';
$_POST['initial_psychi_523']= isset($_POST['initial_psychi_523'])?$_POST['initial_psychi_523']:' ';
$_POST['initial_psychi_524']= isset($_POST['initial_psychi_524'])?$_POST['initial_psychi_524']:' ';
$_POST['initial_psychi_525']= isset($_POST['initial_psychi_525'])?$_POST['initial_psychi_525']:' ';
$_POST['initial_psychi_526']= isset($_POST['initial_psychi_526'])?$_POST['initial_psychi_526']:' ';
$_POST['initial_psychi_527']= isset($_POST['initial_psychi_527'])?$_POST['initial_psychi_527']:' ';
$_POST['initial_psychi_528']= isset($_POST['initial_psychi_528'])?$_POST['initial_psychi_528']:' ';
$_POST['initial_psychi_529']= isset($_POST['initial_psychi_529'])?$_POST['initial_psychi_529']:' ';

$_POST['initial_psychi_531']= isset($_POST['initial_psychi_531'])?$_POST['initial_psychi_531']:' ';
$_POST['initial_psychi_532']= isset($_POST['initial_psychi_532'])?$_POST['initial_psychi_532']:' ';
$_POST['initial_psychi_533']= isset($_POST['initial_psychi_533'])?$_POST['initial_psychi_533']:' ';
$_POST['initial_psychi_534']= isset($_POST['initial_psychi_534'])?$_POST['initial_psychi_534']:' ';
$_POST['initial_psychi_536']= isset($_POST['initial_psychi_536'])?$_POST['initial_psychi_536']:' ';
$_POST['initial_psychi_537']= isset($_POST['initial_psychi_537'])?$_POST['initial_psychi_537']:' ';
$_POST['initial_psychi_538']= isset($_POST['initial_psychi_538'])?$_POST['initial_psychi_538']:' ';
$_POST['initial_psychi_539']= isset($_POST['initial_psychi_539'])?$_POST['initial_psychi_539']:' ';

$_POST['initial_psychi_541']= isset($_POST['initial_psychi_541'])?$_POST['initial_psychi_541']:' ';
$_POST['initial_psychi_542']= isset($_POST['initial_psychi_542'])?$_POST['initial_psychi_542']:' ';
$_POST['initial_psychi_543']= isset($_POST['initial_psychi_543'])?$_POST['initial_psychi_543']:' ';
$_POST['initial_psychi_544']= isset($_POST['initial_psychi_544'])?$_POST['initial_psychi_544']:' ';
$_POST['initial_psychi_546']= isset($_POST['initial_psychi_546'])?$_POST['initial_psychi_546']:' ';
$_POST['initial_psychi_547']= isset($_POST['initial_psychi_547'])?$_POST['initial_psychi_547']:' ';
$_POST['initial_psychi_548']= isset($_POST['initial_psychi_548'])?$_POST['initial_psychi_548']:' ';
$_POST['initial_psychi_549']= isset($_POST['initial_psychi_549'])?$_POST['initial_psychi_549']:' ';


$_POST['initial_psychi_552']= isset($_POST['initial_psychi_552'])?$_POST['initial_psychi_552']:' ';
$_POST['initial_psychi_553']= isset($_POST['initial_psychi_553'])?$_POST['initial_psychi_553']:' ';
$_POST['initial_psychi_554']= isset($_POST['initial_psychi_554'])?$_POST['initial_psychi_554']:' ';
$_POST['text1']= isset($_POST['text1'])?$_POST['text1']:' ';
$_POST['text2']= isset($_POST['text2'])?$_POST['text2']:' ';
$_POST['text6']= isset($_POST['text6'])?$_POST['text6']:' ';
//echo $_POST['text6'];exit;
if ($id && $id != 0) {
    $newid = update_form("form_initial_psychiatric_evaluation", $_POST, $id,$_GET['pid']);
}
else
{
    $newid = submit_form("form_initial_psychiatric_evaluation", $_POST, $_GET["pid"],$encounter);

    addForm($encounter, "Initial Psychiatric Evaluation Status", $newid, "initial_psychiatric_evaluation_form",  $_SESSION["pid"], $userauthorized);
}



formHeader("Redirecting....");
formJump();
formFooter();
