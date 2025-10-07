import axios from 'axios';

// URL base dell'API Laravel - usa la variabile d'ambiente se disponibile
const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000/api';

class FilmService {
    constructor() {
        console.log('🔧 Configurazione FilmService con URL:', API_BASE_URL);

        // Configura axios con l'URL base
        this.api = axios.create({
            baseURL: API_BASE_URL,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            timeout: 10000, // Timeout di 10 secondi
        });

        // Interceptor per gestire errori globalmente
        this.api.interceptors.response.use(
            (response) => response,
            (error) => {
                console.error('Errore API:', error);

                if (error.response) {
                    // Il server ha risposto con un codice di errore
                    console.error('Risposta errore:', error.response.data);
                    console.error('Status:', error.response.status);
                } else if (error.request) {
                    // La richiesta è stata fatta ma non si è ricevuta risposta
                    console.error('Nessuna risposta ricevuta:', error.request);
                } else {
                    // Qualcos'altro ha causato l'errore
                    console.error('Errore configurazione:', error.message);
                }

                return Promise.reject(error);
            }
        );
    }

    /**
     * Recupera tutti i film
     * @returns {Promise} Promise con la lista dei film
     */
    async getAllFilms() {
        try {
            console.log('🚀 Chiamata API: GET /films');
            const response = await this.api.get('/films');
            console.log('✅ Risposta API ricevuta:', response.data);

            // Verifica se i dati sono in un formato valido
            const films = Array.isArray(response.data) ? response.data : [];
            console.log('📊 Film processati:', films.length);

            return films;
        } catch (error) {
            console.error('❌ Errore getAllFilms:', error);
            if (error.response) {
                console.error('Status:', error.response.status);
                console.error('Data:', error.response.data);
            }
            throw new Error('Impossibile recuperare i film: ' + error.message);
        }
    }

    /**
     * Recupera un film specifico per ID
     * @param {number} id - ID del film
     * @returns {Promise} Promise con i dettagli del film
     */
    async getFilmById(id) {
        try {
            console.log(`🚀 Chiamata API: GET /films/${id}`);
            const response = await this.api.get(`/films/${id}`);
            console.log('✅ Risposta API film dettaglio:', response.data);

            return response.data;
        } catch (error) {
            console.error(`❌ Errore getFilmById(${id}):`, error);
            if (error.response) {
                console.error('Status:', error.response.status);
                if (error.response.status === 404) {
                    throw new Error('Film non trovato');
                }
            }
            throw new Error('Impossibile recuperare il film: ' + error.message);
        }
    }

    /**
     * Recupera tutti i generi
     * @returns {Promise} Promise con la lista dei generi
     */
    async getAllGenres() {
        try {
            console.log('🚀 Chiamata API: GET /genres');
            const response = await this.api.get('/genres');
            console.log('✅ Risposta API generi:', response.data);

            const genres = Array.isArray(response.data) ? response.data : [];
            console.log('📊 Generi processati:', genres.length);

            return genres;
        } catch (error) {
            console.error('❌ Errore getAllGenres:', error);
            throw new Error('Impossibile recuperare i generi: ' + error.message);
        }
    }

    /**
     * Verifica se l'API è raggiungibile
     * @returns {Promise} Promise con lo stato dell'API
     */
    async checkApiHealth() {
        try {
            console.log('🚀 Test connessione API: GET /health');
            const response = await this.api.get('/health');
            console.log('✅ API Health Check:', response.data);
            return response.data;
        } catch (error) {
            console.error('❌ API non raggiungibile:', error);
            throw new Error('API non raggiungibile: ' + error.message);
        }
    }
}

// Esporta un'istanza singleton del servizio
export default new FilmService();