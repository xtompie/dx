<?php require_once 'js.php' ?>

<template ticket-tpl>
    <h1 render-model="title"></h1>
    <div>Author: <span render-model="author" render-tpl="[ticket-tpl-person]"></span></div>
    <div>Assigned: <span render-model="assigned" render-tpl="[ticket-tpl-person]"></span></div>
    <p render-model="description" render-mode="html"></p>
    <div render-model="comments" render-tpl="[ticket-tpl-comment]"></div>
</template>
<template ticket-tpl-person>
    <span render-model="name"></span> (<span render-model="email"></span>)</template>
<template ticket-tpl-comment>
    <div><span render-model="author" render-tpl="[ticket-tpl-person]"></span>:</div>
    <div render-model="text" render-mode="html"></div>
</template>
<div ticket-view render-tpl="[ticket-tpl]">
</div>
<script>
    render.update('[ticket-view]', {
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
