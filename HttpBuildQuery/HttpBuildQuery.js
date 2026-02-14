const HttpBuildQuery = (params) => {
    const build = (key, val) => {
        if (val === true) val = "1";
        if (val === false) val = "0";
        if (typeof val === "object") {
            return Object.entries(val).map(([k, v]) => build(`${key}[${k}]`, v)).filter(s => s).join('&');
        }
        if (['string', 'number', 'symbol', 'bigint'].includes(typeof val)) {
            return `${encodeURIComponent(key)}=${encodeURIComponent(val)}`;
        }
        return '';
    };
    return Object.entries(params).map(([k, v]) => build(k, v)).filter(s => s).join('&');
};

