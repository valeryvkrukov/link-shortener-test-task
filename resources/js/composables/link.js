import { ref } from 'vue';
import axios from 'axios';

export default function useShortenedLink() {
    const currentHost = location.protocol + '//' + location.host + location.pathname;
    const shortenedLink = ref('');
    const error = ref('');

    const storeLink = async (data) => {
        error.value = '';

        try {
            await axios
                .post('/api/shortener_form', data)
                .then((response) => {
                    if (response.data.data.shortened_link) {
                        shortenedLink.value = currentHost + response.data.data.shortened_link;
                    } else {
                        throw new Error('Bad service response');
                    }
                });
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    error.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    };

    return {
        error,
        shortenedLink,
        storeLink
    };
}