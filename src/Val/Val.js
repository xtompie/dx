let Val = (() => {
    const Tpl = tpl => typeof tpl === 'string' ? document.one(tpl) : tpl;
    const Fx = (el, write, v = null) => {
        let fx = el.attr('val-fx');
        if (fx && fx !== '' && Val.Fx[fx]) {
            return write ? Val.Fx[fx].Set(el, v) : Val.Fx[fx].Get(el);
        }
    };
    const Sg = (el, write, v = null) => {
        let code = el.attr(write ? 'val-set' : 'val-get');
        if (code) {
            return write
                ? (function () { return eval(code).call(el, v); }).bind(el)()
                : (function () { return eval(code).call(el); }).bind(el)()
            ;
        }
    };
    const Get = el => ({...Fx(el, false) || {}, ...Sg(el, false) || {}});
    const Set = (el, v) => {
        Fx(el, true, v);
        Sg(el, true, v);
    };
    const Frag = (tpl, data) => {
        let frag = tpl.tpl();
        Obj(frag, data);
        return frag;
    };
    const Iter = (el, tpl, data, method) => {
        let t = Tpl(tpl);
        data.each(d => el[method](Frag(t, d)));
    };
    const Obj = (el, data = null) => {
        if (data === null) {
            let d = el.allfd('[val]').reduce((r, e) => Object.assign(r, (Get(e))), {});
            return Object.keys(d).length === 0 ? null : d;
        }
        el.allfd('[val]').each(e => Set(e, data));
    };
    const Arr = (el, data = undefined, tpl = null) => {
        if (data === undefined && tpl === null) {
            return Array.from(el.children).map(e => Obj(e));
        }
        el.innerHTML = '';
        if (data?.length) {
            Iter(el, tpl, data, 'appendChild');
        }
    };
    const Render = (el, tpl, data) => {
        el.innerHTML = '';
        if (data !== undefined && data !== null) {
            let frag = Frag(Tpl(tpl), data);
            el.appendChild(frag);
        }
    };
    const Patch = (el, data) => Obj(el, Object.assign(Obj(el), data));
    const Append = (el, data, tpl = null) => {
        Iter(el, tpl === null ? el.attr('val-tpl') : tpl, data, 'appendChild');
    };
    const Prepend = (el, data, tpl = null) => Iter(el, tpl === null ? el.attr('val-tpl') : tpl, data.reverse(), 'prepend');
    const Modify = (el, callback) => Obj(el, callback(Obj(el)));
    return {
        Get,
        Set,
        Patch,
        Append,
        Prepend,
        Modify,
        Obj,
        Arr,
        Render
    };
})();
