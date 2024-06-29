<?php require_once 'js.php' ?>

<template ticket-tpl>
    <h1 render2="(d) => this.textContent = d.title"></h1>
    <div>Author: <span render2="(d) => render2(this, '[ticket-tpl-person]', d.author)"></span></div>
    <div>Assigned: <span render2="(d) => render2(this, '[ticket-tpl-person]', d.assigned)"></span></div>
    <p render2="(d) => this.innerHTML = d.description"></p>
    <div render2="(d) => render2(this, '[ticket-tpl-comment]', d.comments)"></div>
</template>

<template ticket-tpl-person>
    <span render2="(d) => this.textContent = d.name"></span> (<span render2="(d) => this.textContent = d.email"></span>)
</template>

<template ticket-tpl-comment>
    <div><span render2="(d) => render2(this, '[ticket-tpl-person]', d.author)"></span>:</div>
    <div render2="(d) => this.innerHTML = d.text"></div>
</template>

<div ticket-view></div>

<script>
    render2('[ticket-view]', '[ticket-tpl]', {
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
