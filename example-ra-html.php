<?php require_once 'example-ra-js.php'; ?>
<?php require_once 'example-ra-css.php'; ?>
<?php $questions = require "example-ra-model.php" ?>
<?php $last = count($questions) - 1 ?>
<div ra-space>
    <?php foreach ($questions as $index => $question): ?>

        <div
            ra-page="<?= $index ?>"
            ra-page-question
            <?php if ($index > 0): ?>
                ra-hide
            <?php endif ?>
        >

            <div ra-question><?= htmlspecialchars($question['question']) ?></div>
            <div ra-available>3</div>

            <?php foreach ($question['answer'] as $answer): ?>
                <div ra-answer>
                    <span ra-answer-text><?= htmlspecialchars($answer) ?></span>
                    <button ra-sub onclick="ra.sub(this)" disabled>-</button>
                    <input type="text" ra-value value="0">
                    <button ra-add onclick="ra.add(this)"t>+</button>
                </div>
            <?php endforeach ?>

            <?php if ($index > 0): ?>
                <button onclick="ra.prev(this, '<?= ($index - 1) ?>')">prev</button>
            <?php endif ?>

            <?php if ($index < $last): ?>
                <button onclick="ra.next(this, '<?= ($index + 1) ?>')">next</button>
            <?php else: ?>
                <button onclick="ra.finish(this)">next</button>
            <?php endif ?>

            <div ra-error ra-hide>Use all points</div>

        </div>

    <?php endforeach ?>

    <div ra-page="finished" ra-hide>
        <pre ra-output></pre>
    </div>

</div>