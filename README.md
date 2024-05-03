# DX

DX - JavaScript Architecture Pattern

## Foundation

1. DOM State. State is stored in DOM. State is not stored in javascript variables.
2. Event attibutes. Events are set in html attributes. Events are not dynamic binded with addEventListener.
3. Action in context. Event have current DOMElement from which operation space can be resolved.
4. Module Object and [IIFE](https://en.wikipedia.org/wiki/Immediately_invoked_function_expression)
5. High UX Performance. Zero init time.

## Examples

- [Todo List](./example-todo-list.php)
- [Accordion](./example-accordion.php)
- [Render](./dx-render-example.php)
- [Condition](./dx-condition-example-select.php)
- [Removeitem](./dx-removeitem.php)

To run examples clone this repo, go to repo in cli, run `php -S 127.0.0.1:8000`, open `127.0.0.1:8000` in browser.
