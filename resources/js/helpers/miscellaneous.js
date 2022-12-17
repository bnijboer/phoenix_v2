import {format} from "date-fns";
import {nl} from "date-fns/locale";

function formatDutchDate(dateString) {
    return format(new Date(dateString), 'd LLLL yyyy', {
        locale: nl
    });
}

export {
    formatDutchDate,
}
