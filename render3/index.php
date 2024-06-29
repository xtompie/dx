<script src="https://cdn.jsdelivr.net/npm/mustache@4.2.0/mustache.min.js"></script>

<template ticket-tpl>
    <h1>{{title}}</h1>
    <div>Author: <span>{{author.name}} ({{author.email}})</span></div>
    <div>Assigned: <span>{{assigned.name}} ({{assigned.email}})</span></div>
    <p>{{{description}}}</p>
    <div>
        {{#comments}}
            <div>
                <span>{{author.name}} ({{author.email}})</span>:
            </div>
            <div>{{{text}}}</div>
        {{/comments}}
    </div>
    </div>
</template>

<div ticket-view></div>

<script>
document.querySelector('[ticket-view]').innerHTML = Mustache.render(
    document.querySelector('[ticket-tpl]').innerHTML,
    {
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
