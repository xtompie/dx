<?php require_once 'js.php' ?>

<div validation-space>


    <div validation-logic>
        <div validation-group>
            <div validation-key="email">
                <div validation-validator-required></div>
                <div validation-validator-email></div>
            </div>
            <div validation-key="password">
                <div validation-required></div>
                <div validation-min="6"></div>
                <div validation-regexp="[a-z]"></div>
                <div validation-regexp="[A-Z]"></div>
                <div validation-regexp="[0-9]"></div>
            </div>
            <div validation-main="password_confirm">
                <div validation-callback>Passwords do not match</div>
            </div>
        </div>
    </div>

    <template validation-tpl-errors>
        <div render-model="errors" render-tpl="[validation-tpl-error]"></div>
    </template>
    <template validation-tpl-error>
        <div render-model="message"></div>
    </template>

    <input type="text" name="email" validation-model="email" />
    <div validation-errors="|email|"  render-tpl="[validation-tpl-errors]"></div>

    <input type="password" name="password" validation-model="password" />
    <div validation-errors="" render-tpl="[validation-tpl-errors]"></div>

    <input type="password" name="confirm_password" validation-model="confirm_password" />
    <div validation-errors render-tpl="[validation-tpl-errors]"></div>

    <button type="button" onclick="validation.validate(this)">Submit</button>


</div>