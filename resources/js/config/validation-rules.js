function required(v) {
    return v !== '';
}

function min(v, minLength) {
    return v.length >= minLength;
}

function max(v, maxLength) {
    return v.length <= maxLength;
}

function email(v) {
    return v ? /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(v) : true;
}

function password(v, minLength) {
    if (minLength === void 0) {
        minLength = 8;
    }

    const regexp = new RegExp("(?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[_\\W])[0-9a-zA-Z_\\W]{minLength,255}".replace("minLength", minLength.toString()));

    return v ? regexp.test(v) : true;
}

function passwordEqual(v, password) {
    return v ? v === password : true;
}

function hasNoScriptTags(v) {
    return !/<[a-z][\s\S]*>/.test(v);
}

const ValidationRules = {
    'required': required,
    'min': min,
    'max': max,
    'email': email,
    'password': password,
    'passwordEqual': passwordEqual,
    'hasNoScriptTags': hasNoScriptTags,
};

export default ValidationRules;
