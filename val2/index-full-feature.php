<template ticket-tpl-person>
    <span val val-key="name"></span>
    (<span val val-key="email"></span>)
</template>

<template ticket-tpl-comment>
    <div><span val val-key="author" val-tpl="[ticket-tpl-person]"></span>:</div>
    <div val val-key="text"></div>
</template>

<div ticket-view>
    <h1
        val
        val-key="title"
        val-set="(v) => this.textContent = v"
        val-get="() => this.textContent"
    ></h1>

    <div>Author:
        <span
            val
            val-key="author"
            val-tpl="[ticket-tpl-person]"
            val-set="(v) => val.obj(this, v, '[ticket-tpl-person])"
            val-get="() => val.obj(this)"
        ></span>
    </div>

    <div>
        Assigned:
        <span
            val
            val-key="assigned"
            val-tpl="[ticket-tpl-person]"
            val-set="(v) => val.obj(this, v, '[ticket-tpl-person]')"
            val-get="() => val.obj(this)"
        ></span>
    </div>

    <p
        val
        val-set="(v) => this.innerHTML = v.description"
        val-get="() => {description: this.innerHTML}"
    ></p>


    <div
        val-key="comments"
        val-tpl="[ticket-tpl-comment]"
        val-arr
        val-set="(v) => val.arr(this, v, '[ticket-tpl-comment]')"
        val-get="() => val.arr(this)"
    >
    </div>
</div>