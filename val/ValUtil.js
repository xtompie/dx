HTMLElement.prototype.vappend = function(data, tpl = null) {
    Val.Append(this, data, tpl);
    return this;
};
HTMLElement.prototype.varr = function(data, tpl = null) {
    return Val.Arr(this, data, tpl);
};
HTMLElement.prototype.vget = function() {
    if (this.hasAttribute('val')) {
        return Val.Get(this);
    } else {
        return Val.Obj(this);
    }
}
HTMLElement.prototype.vmodify = function(f) {
    Val.Modify(this, f);
    return this;
};
HTMLElement.prototype.vobj = function(data = null) {
    return Val.Obj(this, data);
};
HTMLElement.prototype.vpatch = function(data) {
    Val.Patch(this, data);
    return this;
};
HTMLElement.prototype.vprepend = function(data, tpl = null) {
    Val.Prepend(this, data, tpl);
    return this;
};
HTMLElement.prototype.vrender = function(data, tpl = null) {
    Val.Render(this, data, tpl);
    return this;
};
HTMLElement.prototype.vset = function(data) {
    if (this.hasAttribute('val')) {
        Val.Set(this, data);
    } else {
        Val.Obj(this, data);
    }
    return this;
};
HTMLElement.prototype.vval = function(data) {
    if (arguments.length === 0) {
        if (this.hasAttribute('val')) {
            return Val.Get(this);
        } else {
            return Val.Obj(this);
        }
    } else {
        if (this.hasAttribute('val')) {
            Val.Set(this, data);
        } else {
            Val.Obj(this, data);
        }
        return this;
    }
};