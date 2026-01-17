Val.Fx = {};
Val.Fx.Obj = {
    Get: el => el.attr('val-key') ? { [el.attr('val-key')]: Val.Obj(el) } : Val.Obj(el),
    Set: (el, data) => el.attr('val-key') ? Val.Obj(el, data[el.attr('val-key')]) : Val.Obj(el, data)
};
Val.Fx.Arr = {
    Get: el => ({ [el.attr('val-key')]: Val.Arr(el) }),
    Set: (el, data) => Val.Arr(el, el.attr('val-tpl'), data[el.attr('val-key')])
};
Val.Fx.Render = {
    Get: el => ({ [el.attr('val-key')]: Val.Obj(el) }),
    Set: (el, data) => Val.Render(el, el.attr('val-tpl'), data[el.attr('val-key')])
};
Val.Fx.Text = {
    Get: el => ({ [el.attr('val-key')]: el.textContent }),
    Set: (el, data) => { el.textContent = data[el.attr('val-key')]; }
};
Val.Fx.Html = {
    Get: el => ({ [el.attr('val-key')]: el.innerHTML }),
    Set: (el, data) => { el.innerHTML = data[el.attr('val-key')]; }
};
Val.Fx.Input = {
    Get: el => ({ [el.attr('val-key')]: el.value }),
    Set: (el, data) => { el.value = data[el.attr('val-key')] || ''; }
};
Val.Fx.Show = {
    Get: el => ({ [el.attr('val-key')]: el.style.display !== 'none' }),
    Set: (el, data) => { el.style.display = data[el.attr('val-key')] ? '' : 'none'; }
};
Val.Fx.Hide = {
    Get: el => ({ [el.attr('val-key')]: el.style.display === 'none' }),
    Set: (el, data) => { el.style.display = data[el.attr('val-key')] ? 'none' : ''; }
};
Val.Fx.Img = {
    Get: el => ({ [el.attr('val-key')]: el.src }),
    Set: (el, data) => { el.src = data[el.attr('val-key')]; }
};
Val.Fx.Attr = {
    Get: el => ({ [el.attr('val-key')]: el.attr(el.attr('val-attr')) }),
    Set: (el, data) => { el.attr(el.attr('val-attr'), data[el.attr('val-key')]); }
}
Val.Fx.If = {
    Get: (el) => {
        const conditionMet = el.style.display !== 'none' && (!el.attr('val-value') || el.attr('val-value') === true);
        const result = conditionMet ? Val.Get(el) : {};
        return conditionMet ? { [el.attr('val-key')]: el.attr('val-value') || true, ...result } : {};
    },
    Set: (el, data) => {
        const conditionMet = el.attr('val-value') ? el.attr('val-value') === data[el.attr('val-key')] : data[el.attr('val-key')];
        el.style.display = conditionMet ? '' : 'none';
        if (conditionMet) {
            Val.Set(el, data);
        }
    }
};

