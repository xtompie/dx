<script> module = {prefix: 'render'}; </script>
<?php require 'render.php' ?>
<script> let render = module; </script>

<template ticket-tpl>
    <h1 render="(d) => this.textContent = d.title"></h1>
    <div>Author: <span render="(d) => render(this, '[ticket-tpl-person]', d.author)"></span></div>
    <div>Assigned: <span render="(d) => render(this, '[ticket-tpl-person]', d.assigned)"></span></div>
    <p render="(d) => this.innerHTML = d.description"></p>
    <div render="(d) => render(this, '[ticket-tpl-comment]', d.comments)"></div>
</template>

<template ticket-tpl-person>
    <span render="(d) => this.textContent = d.name"></span> (<span render="(d) => this.textContent = d.email"></span>)
</template>

<template ticket-tpl-comment>
    <div><span render="(d) => render(this, '[ticket-tpl-person]', d.author)"></span>:</div>
    <div render="(d) => this.innerHTML = d.text"></div>
</template>

<div ticket-view></div>

<script>
    render('[ticket-view]', '[ticket-tpl]', {
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
