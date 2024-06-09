<?php require_once 'js.php' ?>

<div fv-space>

    <template fv-tpl-errors>
        <div render-model="errors" render-tpl="[fv-tpl-error]"></div>
    </template>
    <template fv-tpl-error>
        <div render-model="message"></div>
    </template>

    <div fv-element="email">
        <input type="text" name="email" val-model="email" />
        <div fv-errors render-tpl="[fv-tpl-errors]"></div>
    </div>

    <div fv-element>
        <input type="password" name="password" val-model="password" />
        <div fv-errors render-tpl="[fv-tpl-errors]"></div>
    </div>

    <div fv-element>
        <input type="password" name="confirm_password" val-model="confirm_password" />
        <div fv-errors render-tpl="[fv-tpl-errors]"></div>
    </div>

    <button type="button" onclick="fv.validate(this)">Submit</button>

    <div fv-validation>
        <div fv-group>
            <div fv-model="email">
                <div fv-validator="required"></div>
                <div fv-validator="email"></div>
            </div>
            <div fv-model="password">
                <div fv-validator="required"></div>
            </div>
            <div fv-model="confirm_password">
                <div fv-validator="required"></div>
            </div>
        </div>
        <div fv-group>
            <div fv-model="" fv-element="confirm_password">
                <div fv-validator="callback" fv-validator-callback="(v) => v.password === v.confirm_password" fv-validator-message="Password must be same"></div>
            </div>
        </div>

    </div>

</div>