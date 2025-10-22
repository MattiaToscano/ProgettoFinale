import axios from 'axios';

// URL base dell'API Laravel - usa la variabile d'ambiente se disponibile
const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000/api';

class FilmService {
    constructor() {
        // Configura axios con l'URL base
        this.api = axios.create({
            baseURL: API_BASE_URL,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
        });
    }

    /**
     * Recupero tutti i film
     * @returns {Promise} Promise con la lista dei film
     */
    async getAllFilms() {
        const response = await this.api.get('/films');
        return Array.isArray(response.data) ? response.data : [];
    }

    /**
     * Recupero un film specifico per ID
     * @param {number} id - ID del film
     * @returns {Promise} Promise con i dettagli del film
     */
    async getFilmById(id) {
        const response = await this.api.get(`/films/${id}`);
        return response.data;
    }
}


export default new FilmService();