Val.Fx = {};
Val.Fx.Obj = {
    Get: (el, params) => params.key ? { [params.key]: Val.Obj(el) } : Val.Obj(el),
    Set: (el, data, params) => params.key ? Val.Obj(el, data[params.key]) : Val.Obj(el, data)
};
Val.Fx.Arr = {
    Get: (el, params) => ({ [params.key]: Val.Arr(el) }),
    Set: (el, data, params) => Val.Arr(el, data[params.key], params.tpl)
};
Val.Fx.Render = {
    Get: (el, params) => ({ [params.key]: Val.Obj(el) }),
    Set: (el, data, params) => Val.Render(el, params.tpl, data[params.key])
};
Val.Fx.Text = {
    Get: (el, params) => ({ [params.key]: el.textContent }),
    Set: (el, data, params) => { el.textContent = data[params.key]; }
};
Val.Fx.Html = {
    Get: (el, params) => ({ [params.key]: el.innerHTML }),
    Set: (el, data, params) => { el.innerHTML = data[params.key]; }
};
Val.Fx.Input = {
    Get: (el, params) => ({ [params.key]: el.value }),
    Set: (el, data, params) => { el.value = data[params.key] || ''; }
};
Val.Fx.Show = {
    Get: (el, params) => ({ [params.key]: el.style.display !== 'none' }),
    Set: (el, data, params) => { el.style.display = data[params.key] ? '' : 'none'; }
};
Val.Fx.Hide = {
    Get: (el, params) => ({ [params.key]: el.style.display === 'none' }),
    Set: (el, data, params) => { el.style.display = data[params.key] ? 'none' : ''; }
};
Val.Fx.Img = {
    Get: (el, params) => ({ [params.key]: el.src }),
    Set: (el, data, params) => { el.src = data[params.key]; }
};
Val.Fx.Attr = {
    Get: (el, params) => ({ [params.key]: el.attr(params.attr) }),
    Set: (el, data, params) => { el.attr(params.attr, data[params.key]); }
};
Val.Fx.If = {
    Get: (el, params) => {
        const conditionMet = el.style.display !== 'none' && (!params.value || params.value === 'true');
        if (!conditionMet) {
            return {};
        }
        const result = el.allfd('[val]').reduce((r, e) => Object.assign(r, Val.Get(e)), {});
        return { [params.key]: result };
    },
    Set: (el, data, params) => {
        const conditionMet = params.value ? params.value === data[params.key] : data[params.key];
        el.style.display = conditionMet ? '' : 'none';
        if (conditionMet && data[params.key]) {
            el.allfd('[val]').each(e => Val.Set(e, data[params.key]));
        }
    }
};
Val.Fx.Fxs = {
    Get: (el, params) => {
        return Array.from(el.querySelector('[val-fxs]')?.children ?? []).reduce((result, fxEl) => {
            const fx = fxEl.attr('val-fx');
            return (fx && Val.Fx[fx])
                ? Object.assign(result, Val.Fx[fx].Get(el, Val.FxParams(fxEl)))
                : result;
        }, {});
    },
    Set: (el, data, params) => {
        Array.from(el.querySelector('[val-fxs]')?.children ?? []).forEach(fxEl => {
            const fx = fxEl.attr('val-fx');
            fx && Val.Fx[fx] && Val.Fx[fx].Set(el, data, Val.FxParams(fxEl));
        });
    }
};
