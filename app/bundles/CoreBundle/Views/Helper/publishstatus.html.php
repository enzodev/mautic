<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic, NP. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

$status = $item->getPublishStatus();
switch ($status) {
    case 'published':
        $icon = " fa-check-circle-o text-success";
        $text = $view['translator']->trans('mautic.core.form.published');
        break;
    case 'unpublished':
        $icon = " fa-times-circle-o text-danger";
        $text = $view['translator']->trans('mautic.core.form.unpublished');
        break;
    case 'expired':
        $icon = " fa-clock-o text-danger";
        $text = $view['translator']->trans('mautic.core.form.expired', array(
            '%date%' => $view['date']->toFull($item->getPublishDown())
        ));
        break;
    case 'pending':
        $icon = " fa-clock-o text-warning";
        $text = $view['translator']->trans('mautic.core.form.pending', array(
            '%date%' => $view['date']->toFull($item->getPublishUp())
        ));
        break;
}

$clickAction = (isset($disableToggle) && $disableToggle === false) ? '' : ' has-click-event';
$idClass     = str_replace('.', '-', $model) . '-publish-icon' . $item->getId();
?>

<i class="fa fa-fw fa-lg <?php echo $icon . $clickAction . " " . $idClass; ?>"
   data-toggle="tooltip"
   data-container="body"
   data-placement="right"
   data-status="<?php echo $status; ?>"
   data-original-title="<?php echo $text ?>"
   <?php if (empty($disableToggle)): ?>
   onclick="Mautic.togglePublishStatus(event, '.<?php echo $idClass; ?>', '<?php echo $model; ?>', <?php echo $item->getId(); ?>);"
   <?php endif; ?>></i>