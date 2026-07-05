---
slug: rationale
title: "Why this way"
type: concept
tags: [foundations, defense, rationale]
related: [modularization, dom-state, where-domain-lives]
track: deeper
order: 80
status: draft
---

# Why this way

The conventions in DX provoke the same objections every time. Here are the cross-cutting ones,
answered plainly.

## Global modules are fine

Modules are global objects, and that reads as a smell to anyone trained on dependency injection.
But globals are not the problem people think they are. Vue registers global components; every app
has a global router, a global store. The objection is mostly reflex. What you skip by *not*
adding an IoC container or an event bus up front is a layer of indirection most apps never need.
You can add one the day you do — you just don't pay for it on day one. Attribute prefixes keep the
namespace clean by convention, the same way BEM keeps CSS class names clean.

## No npm, no node, no tree-shaking

There is no build because there is nothing to build. No bundler means no tree-shaking, because
you only ever ship the files you wrote. No `node_modules`, no lockfile, no supply chain to audit,
no toolchain that breaks on a major-version bump. The cost this removes is not small — it is most
of the operational weight of a modern frontend.

## Attributes are the contract between JS and HTML

The link between a module and its markup is its namespaced attributes. That is deliberate: the
contract lives in the DOM, where it is visible and greppable, instead of in a type that only
exists at build time. "Who uses `cart-row`?" is one search. The trade is real — it is a string
contract, not compiler-checked — which is exactly why we write it down as a
[module signature](modularization.html).

## A model in JS, even when you don't strictly need one

DX keeps presentation state in the DOM, but it does not forbid a JavaScript model. When there is
genuine domain logic, you write it as a plain module and test it in isolation — see
[where domain logic lives](where-domain-lives). The discipline is narrow: don't keep a *second
copy of what's on screen*. Everything else is ordinary code.
