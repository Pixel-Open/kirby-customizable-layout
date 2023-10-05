<?= css('media/plugins/pixelopen/customizable-layout/styles.css')?>

<?php
    foreach ($field->toLayouts() as $layout) :
    $classColumnChild = [];
    $layout_settings = $layout->attrs();
    foreach ($layout->columns() as $column) {
        $classColumnChild[] = str_replace('/', '', $column->width());
        $classColumns = implode("-", $classColumnChild);
    }
?>
    <section class="flex justify-<?= $layout_settings->x_align()
    ?>" style="<?php if ($layout_settings->image()->toFile()) {
        echo "background-image: url(" . $layout_settings->image()->toFile()->url() . "); background-position: center center; background-size: cover;";
    }
    ?><?php if ($layout_settings->background() != "") {
                echo "background-color: " . $layout_settings->background();
            }
    ?>" id="<?= esc($layout->id(), 'attr') ?>">
      <?php
    $col_disp = "";
    foreach ($layout->columns() as $column) {
        $isSetting = false;
        foreach ($column->blocks() as $block) {
            if ($block->type() == "settings") {
                $col_disp .= $block->width() . "fr ";
                $isSetting = true;
                break;
            }
        }
        if (! $isSetting) {
            $col_disp .= "3fr ";
        }
    }
    ?><div class="<?= esc($layout_settings->class(), 'attr') ?> bloc__columns__<?= $classColumns; ?> layout py-8 grid max-w-7xl h-full gap-<?= $layout_settings->column_gap() ?> w-<?= $layout_settings->width()
    ?>" id="<?= esc($layout_settings->id(), 'attr')
    ?>" style="grid-template-columns: <?= $col_disp ?>;" <?php
        foreach ($layout_settings->toArray() as $key => $value) :
            if ($value != "" && $value != 0 && $value != "false" && str_contains($key, "data-aos")) {
                echo "$key=\"$value\" ";
            }
        endforeach;
    ?>>
    <?php foreach ($layout->columns() as $column) : ?>
    <div <?php
        $settingsSet = false;
        $setting_block = null;
        foreach ($column->blocks() as $block) {
            if (! $settingsSet && $block->type() == "block-settings") {
                $setting_block = $block;
                foreach ($block->content()->toArray() as $key => $value) {
                    if ($value != "" && $value != 0 && $value != "false" && str_contains($key, "data-aos")) {
                        echo "$key=\"$value\" ";
                    }
                    if ($value != "" && $key == "x_align") {
                        echo "align=\"$value\" ";
                    }
                }
            }
        }
        ?>class="column prose max-w-7xl flex flex-wrap column__<?= esc($column->span(), 'css') ?><?php
                if ($setting_block != null) {
                    echo "" . esc($setting_block->class(), 'attr') . " ";
                    echo "content-" . esc($setting_block->y_align(), 'attr') . " ";

                    if (count($layout->columns()) > 1) {
                        if ($setting_block->image()->toFile() || $setting_block->background() != "") {
                            echo "p-" . $setting_block->margin() . " ";
                        } elseif ($column == $layout->columns()->first()) {
                            echo "pr-" . $setting_block->margin() . " ";
                        } elseif ($column == $layout->columns()->last()) {
                            echo "pl-" . $setting_block->margin() . " ";
                        } else {
                            echo "px-" . $setting_block->margin() . " ";
                        }
                    }
                }
            ?>" <?php
            if ($setting_block != null) :
            ?>id="<?= ($setting_block != null ? esc($setting_block->id(), 'attr') : "")
            ?>" style="<?php
                if ($setting_block->image()->toFile()) {
                    echo "background-image: url(" . $setting_block->image()->toFile()->url() . "); background-position: center center; background-size: cover;";
                }
                if ($setting_block->background() != "") {
                    echo "background-color: " . $setting_block->background();
                }
        ?>"<?php endif
        ?>>
          <?php
            foreach ($column->blocks() as $block) :
                if ($block->type() != "settings") :
        ?><div class="prose [&>p]:my-0 flex-none max-w-none shrink basis-full<?php if ($setting_block != null) {
                            if ($block != $column->blocks()->last() && $block->next()->type() != "settings") {
                                echo " " . $setting_block->blocksSpace(); }}
                    ?>"><?php
                    $color_style = $setting_block != null && $setting_block->text_color() != "" ? " style=\"color: " . $setting_block->text_color() . "\"" : ($layout_settings->text_color() != "" ? " style=\"color: " . $layout_settings->text_color() . "\"" : "");
                    $uri = preg_replace("/<figcaption/", "<figcaption" . $color_style ,preg_replace("/\s+/", " ", $block->toHtml()));
                    $pattern = '{<(.*)( .*)?>(.*)<\/\1>}';

                    if (preg_match($pattern, $uri, $matches)) {
                        echo("<" . $matches[1] . $matches[2] . $color_style . ">" . $matches[3] . "</" . $matches[1] . ">");
                    }
            ?></div>
            <?php
                    endif;
            endforeach ?></div>
    <?php endforeach
    ?>  </div>
    </section>
<?php endforeach ?>

<script>
    function onResizePhone() {
        const layouts = document.getElementsByClassName('layout');
        for (const layout of layouts) {
            layout.style.transitionDuration = "0s";
            layout.style.width = window.innerWidth + "px";
        }
    }
    function onResize() {
        const layouts = document.getElementsByClassName('layout');
        for (const layout of layouts) {
            layout.style.transitionDuration = "0s";
            layout.style.marginLeft = (window.innerWidth - 1280) / 2 + "px";
            layout.style.marginRight = (window.innerWidth - 1280) / 2 + "px";
        }
    }

    if (window.innerWidth < '1280') {
        const layouts = document.getElementsByClassName('layout');
        for (const layout of layouts) {
            layout.style.gridTemplateColumns = "minmax(0, 1fr)";
        }
        window.addEventListener('resize', onResizePhone);
        onResizePhone();
    }
    else {
        window.addEventListener('resize', onResize);
        onResize();
    }
</script>