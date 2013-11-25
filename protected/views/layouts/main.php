<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
            </script>
        <![endif]-->
    <?php if (Yii::app()->params['less_dev_mode']): { ?>
        <link rel="stylesheet/less" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/less/site.less?time=<?= time() ?>"/>
        <?php Yii::app()->clientScript->registerScriptFile('<?php echo Yii::app()->request->baseUrl; ?>/js/less-1.3.0.min.js'); ?>
    <?php } else: { ?>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/site.css"/>
    <?php } endif; ?>

    <?php echo $this->renderPartial('//shared/_google_analytics'); ?>

    <title><?php echo MyHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<header>
        <div class="container">
            <a href="/site/index" id="logo"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.jpg" /></a>
            <div class="navbar">
                <ul class="nav pull-right navigation">
                <li class="<? if(Yii::app()->controller->action->id=='index') echo 'active'; ?>"><a href="/site/index"><?php echo Yii::t('app' , 'Home'); ?></a>|</li>
                <li class="<? if(Yii::app()->controller->action->id=='about') echo 'active'; ?>"><a href="/site/about"><?php echo Yii::t('app' , 'About')?></a>|</li>
                <li class="<? if(Yii::app()->controller->action->id=='contact') echo 'active'; ?>"><a href="/site/contact"><?php echo Yii::t('app' , 'Contact')?></a>|</li>
                <li class="<? if(Yii::app()->controller->action->id=='term') echo 'active'; ?>"><a href="/site/term"><?php echo Yii::t('app' , 'Terms of use')?></a></li>
                </ul>
            </div>
            <p>
                <?/*= Utils::languageChangingLinks() */?>
                <a class="btn" href="/site/help"><?php echo Yii::t('app' , 'Help'); ?></a>
                <?php if(Yii::app()->user->isGuest): { ?>
                <a class="btn" href="/site/login"><?php echo Yii::t('app' , 'Login');?></a>
                <a class="btn" href="/user/create" id="btnCreateAccount" title="<?php echo Yii::t('app' , 'An account with GigaDB is required if you want to upload a dataset or be automatically notified of new content of interest to you'); ?>"><?php echo Yii::t('app' , 'Create account'); ?></a>
                <?php } else: { ?>
                  <a class="btn" href="/user/view_profile"><?php echo Yii::t('app' , Yii::app()->user->first_name.'\'s GigaDB Page'); ?></a>
                    <?php if (Yii::app()->user->checkAccess('admin')) { ?>
                    <a class="btn" href="/site/admin"><?php echo Yii::t('app' , 'Administration'); ?></a>
                    <?php } ?>
                    <a class="btn" href="/site/logout"><?php echo Yii::t('app' , 'LogOut'); ?></a>
                <?php } endif; ?>
            </p>
        </div>
</header>
<!--
    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('bootstrap.widgets.BootBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
        )); ?>
    <?php endif?>
-->

<div class="container" id="wrap">
    <?php echo $content; ?>
</div>
<footer id="footer">
    <div class="container">
        <div class="pull-left">
            <a  class="pull-left" title="(Giga)nScience" href="http://www.gigasciencejournal.com/"><img src="/images/gigascience.png" height="32" alt="GigaScience"/></a>
            <a  class="pull-left footer-logo" title="BGI" href="http://en.genomics.cn/navigation/index.action"><img src="/images/bgi-logo.png" height="32" alt="BGI"/></a>
            <a  class="pull-left footer-logo" title="China National Genebank" href="http://www.nationalgenebank.org/"><img src="/images/chinagenbank.png" height="32" alt="China National Genebank"/></a>
        </div>
        <div class="navbar">
            <ul class="nav">
            <li class="<?php if(Yii::app()->controller->action->id=='index') echo 'active'; ?>"><a href="/site/index"><?php echo Yii::t('app' , 'Home'); ?></a>|</li>
                <?php if(Yii::app()->user->isGuest): { ?>
                <li class="<?php if(Yii::app()->controller->action->id=='login') echo 'active'; ?>"><a href="/site/login"><?php echo Yii::t('app' , 'Login')?></a>|</li>
                <?php } else: { ?>
                <li class="<?php if(Yii::app()->controller->action->id=='view_profile') echo 'active'; ?>"><a href="/user/view_profile"><?php echo Yii::t('app' , Yii::app()->user->first_name.'\'s GigaDB Page'); ?></a>|</li>
                <?php } endif; ?>
                <li class="<?php if(Yii::app()->controller->action->id=='about') echo 'active'; ?>"><a href="/site/about"><?php echo Yii::t('app' , 'About'); ?></a>|</li>
                <li class="<?php if(Yii::app()->controller->action->id=='contact') echo 'active'; ?>"><a href="/site/contact"><?php echo Yii::t('app' , 'Contact'); ?></a>|</li>
                <li class="<?php if(Yii::app()->controller->action->id=='term') echo 'active'; ?>"><a href="/site/term"><?php echo Yii::t('app' , 'Terms of use'); ?></a></li>
            </ul>
        </div>
        <div class="pull-right">
            <ul class="social-links">
            <li id="share_facebook"><a href="http://facebook.com/GigaScience"><?php echo Yii::t('app' , 'Be a fan on Facebook'); ?></a></li>
            <li id="share_twitter"><a href="http://twitter.com/GigaScience"><?php echo Yii::t('app' , 'Follow us on Twitter'); ?></a></li>
            <li id="share_weibo"><a href="http://weibo.com/gigasciencejournal"><?php echo Yii::t('app' , 'Follow us on Sina'); ?></a></li>
            <li id="share_google"><a href="https://plus.google.com/u/0/104409890199786402308"><?php echo Yii::t('app' , 'Follow us on Google+'); ?></a></li>
            <li id="share_rss"><a href="http://blogs.openaccesscentral.com/blogs/gigablog/"><?php echo Yii::t('app' , 'GigaBlog'); ?></a></li>
            </ul>
        </div>
    </div>
</footer><!-- footer -->
    <!-- Le javascript
     ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
     <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
     <!-- <script src="/js/jquery.js"></script>-->
     <!-- <script src="/js/google-code-prettify/prettify.js"></script>-->
     <!-- <script src="/js/bootstrap-transition.js"></script>
     <script src="/js/bootstrap-alert.js"></script>
     <script src="/js/bootstrap-modal.js"></script>
     <script src="/js/bootstrap-dropdown.js"></script>
     <script src="/js/bootstrap-scrollspy.js"></script>
     <script src="/js/bootstrap-tab.js"></script>
     <script src="/js/bootstrap-tooltip.js"></script>
     <script src="/js/bootstrap-popover.js"></script>
     <script src="/js/bootstrap-button.js"></script>
     <script src="/js/bootstrap-collapse.js"></script>
     <script src="/js/bootstrap-carousel.js"></script>
     <script src="/js/bootstrap-typeahead.js"></script>-->
     <!-- <script src="/js/application.js"></script>-->

</body>
</html>

<script>
$("#btnCreateAccount").tooltip({'placement':'left'});
</script>
