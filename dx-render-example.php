<?php require_once 'dx-render.php' ?>

<div>
    <template ticket-tpl>
        <h1 dx-render-model="title"></h1>
        <div>Author: <span dx-render-model="author" dx-render-tpl="[ticket-tpl-person]"></span></div>
        <div>Assigned: <span dx-render-model="assigned" dx-render-tpl="[ticket-tpl-person]"></span></div>
        <p dx-render-model="description" dx-render-mode="html"></p>
        <div dx-render-model="comments" dx-render-tpl="[ticket-tpl-comment]"></div>
    </template>
    <template ticket-tpl-person>
        <span dx-render-model="name"></span> (<span dx-render-model="email"></span>)</template>
    <template ticket-tpl-comment>
        <div><span dx-render-model="author" dx-render-tpl="[ticket-tpl-person]"></span>:</div>
        <div dx-render-model="text" dx-render-mode="html"></div>
    </template>
    <div ticket-spawn>

    </div>
    <script>
         dx.render.append('[ticket-spawn]', '[ticket-tpl]', {
            title: 'Ticket #123',
            description: '<b>Warning!</b> Some description',
            author: {
                name: 'John Doe',
                email: 'j.doe@example.com',
            },
            assigned: {
                name: 'Max Mustermann',
                email: 'm.mustermann@example.com',
            },
            comments: [
                {
                    text: 'Some comment 1 ',
                    author: {
                        name: 'John Doe',
                        email: 'j.doe@example.com',
                    },
                },
                {
                    text: 'Some comment 2',
                    author: {
                        name: 'John Doe',
                        email: 'j.doe@example.com',
                    },
                },
                {
                    text: 'Some comment 3',
                    author: {
                        name: 'John Doe',
                        email: 'j.doe@example.com',
                    },
                },
            ],
        });
    </script>
</div>