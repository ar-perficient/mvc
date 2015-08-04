<!DOCTYPE html>
<html>
<head>
<title><?php echo $this->getTitle();?></title>
<link rel="icon" type="image/ico" href="<?php echo $this->getBaseUrl(); ?>favicon.ico"/>
<link rel='stylesheet'  href='<?php echo $this->getCssPath();?>style.css' type='text/css' media='all' />
</head>
<body>
    <?php if (null !== $this->getErrorMessage()) { ?>
    <div class="isa_error">
        <i class="fa fa-times-circle"></i>
        <?php echo $this->getErrorMessage().'<br/>'; ?>
    </div>
    <?php } ?>
    <?php if (null !== $this->getWarningMessage()) { ?>
    <div class="isa_warning">
        <i class="fa fa-warning"></i>
        <?php echo $this->getWarningMessage().'<br/>'; ?>
    </div>
    <?php } ?>
    <?php if (null !== $this->getNoticeMessage()) { ?>
    <div class="isa_info">
        <i class="fa fa-info-circle"></i>
        <?php echo $this->getNoticeMessage().'<br/>'; ?>
    </div>
    <?php } ?>
    <?php if (null !== $this->getSuccessMessage()) { ?>
    <div class="isa_success">
        <i class="fa fa-check"></i>
        <?php echo $this->getSuccessMessage().'<br/>'; ?>
    </div>
    <?php } ?>
    