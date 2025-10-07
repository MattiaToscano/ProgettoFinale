import { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import FilmService from '../services/FilmService';

function FilmDetail() {
    const { id } = useParams();
    const [film, setFilm] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        loadFilm();
    }, [id]);

    const loadFilm = async () => {
        try {
            const filmData = await FilmService.getFilmById(id);
            setFilm(filmData);
            setLoading(false);
        } catch (err) {
            setError('Errore nel caricamento del film');
            setLoading(false);
        }
    };

    if (loading) {
        return (
            <div className="container mt-5">
                <div className="text-center">
                    <div className="spinner-border text-primary" role="status">
                        <span className="visually-hidden">Caricamento...</span>
                    </div>
                </div>
            </div>
        );
    }


    return (
        <div className="container-fluid py-5" style={{ backgroundColor: '#f8f9fa', minHeight: '100vh' }}>
            <div className="container">
                <div className="mb-4">
                    <a href="/" className="btn btn-outline-secondary">
                        ← Torna alla collezione
                    </a>
                </div>

                <div className="row">
                    <div className="col-md-8">
                        <div className="card shadow-sm mb-4">
                            <div className="card-header bg-primary text-white">
                                <h1 className="mb-1">{film.title}</h1>
                                <div className="row">
                                    <div className="col-md-3">
                                        <strong>Anno:</strong> {film.release_year}
                                    </div>
                                    <div className="col-md-3">
                                        <strong>Durata:</strong> {film.duration_minutes} min
                                    </div>
                                    <div className="col-md-6">
                                        <strong>Regista:</strong> {film.director}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="card shadow-sm">
                            <div className="card-header">
                                <h5>Trama</h5>
                            </div>
                            <div className="card-body">
                                <p>{film.description}</p>
                            </div>
                        </div>
                    </div>

                    <div className="col-md-4">
                        {/* Poster */}
                        <div className="card shadow-sm mb-3">
                            <div className="card-header">
                                <h5>Poster</h5>
                            </div>
                            <div className="card-body text-center">
                                {film.poster_url ? (
                                    <img
                                        src={film.poster_url}
                                        alt={`Poster di ${film.title}`}
                                        className="img-fluid rounded"
                                        style={{ maxHeight: '400px' }}
                                    />
                                ) : (
                                    <div className="text-muted">
                                        <i className="fas fa-film fa-4x mb-3"></i>
                                        <p>Nessun poster disponibile</p>
                                    </div>
                                )}
                            </div>
                        </div>

                        {/* Recensione/Rating */}
                        <div className="card shadow-sm mb-3">
                            <div className="card-header">
                                <h5>Recensione</h5>
                            </div>
                            <div className="card-body text-center">
                                {film.rating ? (
                                    <div>
                                        <div className="display-4 text-warning mb-2">
                                            <i className="fas fa-star"></i>
                                        </div>
                                        <h3 className="mb-1">{film.rating}/10</h3>
                                        <p className="text-muted mb-0">Valutazione</p>
                                    </div>
                                ) : (
                                    <div className="text-muted">
                                        <i className="fas fa-star-o fa-3x mb-3"></i>
                                        <p className="mb-0">Nessuna valutazione</p>
                                    </div>
                                )}
                            </div>
                        </div>

                        {/* Generi */}
                        <div className="card shadow-sm">
                            <div className="card-header">
                                <h5>Generi</h5>
                            </div>
                            <div className="card-body">
                                {film.genres && film.genres.length > 0 ? (
                                    <div>
                                        {film.genres.map((genre) => (
                                            <span key={genre.id} className="badge bg-secondary me-2 mb-2">
                                                {genre.name}
                                            </span>
                                        ))}
                                    </div>
                                ) : (
                                    <p className="text-muted">Nessun genere associato</p>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default FilmDetail;