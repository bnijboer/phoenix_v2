function required(v) {
    return v !== '';
}

function max(v, maxLength) {
    return v.length <= maxLength;
}

// const required = (v) => v !== '';
// const min = (v, minLength) => v.length >= minLength;
// const max = (v, maxLength) => v.length <= maxLength;
// const email = (v) => v ? /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(v) : true;
// const password = (v, minLength) => {
//     if (minLength === void 0) {
//         minLength = 8;
//     }
//
//     const regexp = new RegExp("(?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[_\\W])[0-9a-zA-Z_\\W]{minLength,255}".replace("minLength", minLength.toString()));
//
//     return v ? regexp.test(v) : true;
// }
// const passwordEqual = (v, otherPassword) => v ? v === otherPassword : true;
// const hasNoScriptTags = (v) => !/<[a-z][\s\S]*>/.test(v);
//
// export {
//     required,
//     min,
//     max,
//     email,
//     password,
//     passwordEqual,
//     hasNoScriptTags
// }

const ValidationRules = {
    'required': required,
    'max': max,
};

export default ValidationRules;
