const ErrorMessages = {
    required: (v) => 'Dit veld is verplicht',
    max: (v) => `Veld mag maximaal ${v} tekens bevatten`,
    min: (v) => `Veld moet minimaal ${v} tekens bevatten`,
    email: (v) => 'Geen geldig e-mailadres',
    password: (v) => 'Wachtwoord moet # tekens bevatten',
    passwordEqual: (v) => 'Wachtwoorden zijn niet gelijk',
    hasNoScriptTags: (v) => 'Veld bevat tekens die niet zijn toegestaan',
}

export default ErrorMessages;
