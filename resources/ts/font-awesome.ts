import { library } from '@fortawesome/fontawesome-svg-core';
import {
    faBackspace,
    faCircleCheck,
    faEnvelope,
    faEye,
    faFileArrowDown,
    faFilePdf,
    faFilePen,
    faPenToSquare,
    faSquarePlus,
    faTrash,
} from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(faTrash, faSquarePlus, faFileArrowDown, faFilePdf, faFilePen, faEnvelope, faBackspace, faPenToSquare, faEye, faCircleCheck);

export { FontAwesomeIcon };
