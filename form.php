<div class="sscc_box">
    <style scoped>
        .sscc_box{
            display: flex;
            flex-direction: column;
        }
        .sscc_field{
            display: contents;
        }
        .sscc_field input{
            border: 1px solid rgb(102, 153, 255);
        }
        .sscc_field input:focus{
            background-color: rgba(102, 153, 255,.5);
        }
    </style>
    <p class="sscc-meta-options sscc_field">
        <label for="sscc_pricat"><?php echo 'show these categories (use / for separator)' ?></label>
        <input id="sscc_pricat" type="text" name="sscc_pricat" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'sscc_pricat', true ) ); ?>">
    </p>
    <p class="sscc-meta-options sscc_field">
        <label for="sscc_classes"><?php echo 'classes (use space for multiple classes)' ?></label>
        <input id="sscc_classes" type="text" name="sscc_classes" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'sscc_classes', true ) ); ?>">
    </p>

</div>