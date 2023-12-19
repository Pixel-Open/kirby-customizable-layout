<?php $getColorName = function (string $hex): string {
    $color = Kirby\Cms\Blueprint::find('fields/color')['options'];
    $colorName = array_search(strtoupper($hex), $color);
    return str_replace(' ', '-', strtolower($colorName));
} ?>

<?php
foreach ($field->toLayouts() as $layout):
    $layout_settings = $layout->attrs();
    ?>
    <section
        class=
            "customizable_layout__section
            customizable_layout__layout--align-<?= $layout_settings->x_align() ?>
            <?= $layout_settings->background()->isNotEmpty() ? "bg-" . ($getColorName($layout_settings->background()) ?? $layout_settings->background()) : "" ?>
            <?= $layout_settings->text_color()->isNotEmpty() ? "text-" . ($getColorName($layout_settings->text_color()) ?? $layout_settings->text_color()) : "" ?>"

        <?= $layout_settings->image()->toFile() ? "style=\"background-image: url({$layout_settings->image()->toFile()->url()})\"" : "" ?>
    >

    <?php
    $blockSettings = [];
    $col_disp = "";
    foreach ($layout->columns() as $column) {
        $isSetting = false;
        foreach ($column->blocks() as $block) {
            if ($block->type() == "block-settings") {
                $col_disp .= '-' . $block->width();
                $isSetting = true;
                $blockSettings[$column->id()] = $block;
                break;
            }
        }
        if (! $isSetting) {
            $col_disp .= "-3";
            $blockSettings[$column->id()] = null;
        }
    }?>

    <div
        class=
            "customizable_layout__layout
            "<?= $layout_settings->class()->isNotEmpty() ? esc($layout_settings->class(), 'attr') : "" ?>
            customizable_layout__layout--bloc-columns<?= $col_disp ?>
            customizable_layout__layout--gap-<?= $layout_settings->column_gap() ?>
            customizable_layout__layout--width-<?= $layout_settings->width()?>"
        <?= $layout_settings->content()->get('id')->isNotEmpty() ? "id=\"{$layout_settings->content()->get('id')->esc()}\"" : "" ?>

        <?php foreach ($layout_settings->content()->toArray() as $key => $value) {
            if ($value != "" && $value != 0 && $value != "false" && str_contains($key, "data-aos")) {
                echo "$key=\"$value\" ";
            }
        } ?>
    >

        <?php foreach ($layout->columns() as $column) : ?>
        <div
            <?php $setting_block = $blockSettings[$column->id()];
            if ($setting_block) {
                foreach ($block->content()->toArray() as $key => $value) {
                    if ($value != "" && $value != 0 && $value != "false" && str_contains($key, "data-aos")) {
                        echo "$key=\"$value\" ";
                    }
                }
            }?>
            class=
                "customizable_layout__column
                <?php if ($setting_block): ?>
                <?= $setting_block->class()->isNotEmpty() ? "{$setting_block->class()->esc()}" : "" ?>
                <?= $setting_block->background()->isNotEmpty() ? "bg-" . ($getColorName($setting_block->background()) ?? $setting_block->background()) : "" ?>
                <?= $setting_block->text_color()->isNotEmpty() ? "text-" . ($getColorName($setting_block->text_color()) ?? $setting_block->text_color()) : "" ?>
                <?= $setting_block->x_align()->isNotEmpty() ? "customizable_layout__column--x-align-{$setting_block->x_align()}" : "" ?>
                <?= $setting_block->y_align()->isNotEmpty() ? "customizable_layout__column--y-align-{$setting_block->y_align()}" : "" ?>
                customizable_layout__column--width-<?= $setting_block->width() ?>
                customizable_layout__column--margin-<?= $setting_block->margin() ?>
                <?= $setting_block->blockSpace()->isNotEmpty() ? "customizable_layout__column--block-space-{$setting_block->blockSpace()}" : "" ?>
                <?php endif ?>"

            <?php if ($setting_block != null): ?>
            <?= $setting_block->content()->get('id')->isNotEmpty() ? "id=\"{$setting_block->content()->get('id')->esc()}\"" : "" ?>
            <?= $setting_block->image()->toFile() ? "style=\"background-image: url({$setting_block->image()->toFile()->url()})\"" : "" ?>
            <?php endif ?>
        >
            <?php foreach ($column->blocks() as $block):
                if ($block->type() != "block-settings"): ?>
                    <div class="customizable_layout__block">
                        <?= $block->toHtml() ?>
                    </div>
                <?php endif;
            endforeach ?>
        </div>
        <?php endforeach ?>
    </div>
</section>
<?php endforeach ?>
