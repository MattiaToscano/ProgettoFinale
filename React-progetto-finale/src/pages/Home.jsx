import { useState, useEffect } from 'react';
import FilmService from '../services/FilmService';

function Home() {
    const [films, setFilms] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        loadFilms();
    }, []);

    const loadFilms = async () => {
        try {
            const filmsData = await FilmService.getAllFilms();
            setFilms(filmsData);
            setLoading(false);
        } catch (err) {
            setError('Errore nel caricamento dei film');
            setLoading(false);
        }
    };

    // Colori Bootstrap 
    const cardColors = [
        'bg-primary',
        'bg-secondary',
        'bg-success',
        'bg-danger',
        'bg-warning',
        'bg-info'
    ];

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
                <div className="text-center mb-5">
                    <h1 className="display-4 fw-bold text-dark">La Mia Collezione Film</h1>
                    <p className="lead text-muted">Scopri la collezione di {films.length} film disponibili</p>
                </div>

                <div className="row g-4">
                    {films.map((film, index) => {
                        const cardColor = cardColors[index % cardColors.length];

                        return (
                            <div key={film.id} className="col-lg-4 col-md-6">
                                <div
                                    className="card h-100 shadow border-3"
                                    style={{
                                        borderRadius: '20px',
                                        borderColor: '#dee2e6',
                                        borderStyle: 'solid',
                                        transition: 'transform 0.3s ease, box-shadow 0.3s ease'
                                    }}
                                    onMouseEnter={(e) => {
                                        e.currentTarget.style.transform = 'translateY(-8px)';
                                        e.currentTarget.style.boxShadow = '0 15px 35px rgba(0,0,0,0.2)';
                                        const img = e.currentTarget.querySelector('img');
                                        if (img) img.style.transform = 'scale(1.05)';
                                    }}
                                    onMouseLeave={(e) => {
                                        e.currentTarget.style.transform = 'translateY(0)';
                                        e.currentTarget.style.boxShadow = '0 0.125rem 0.25rem rgba(0, 0, 0, 0.075)';
                                        const img = e.currentTarget.querySelector('img');
                                        if (img) img.style.transform = 'scale(1)';
                                    }}
                                >
                                    <div className={`card-header text-white text-center py-3 ${cardColor}`}>
                                        <div className="d-flex justify-content-between align-items-center mb-2">
                                            <span className="h5 fw-bold mb-0">{film.release_year}</span>
                                            {film.genres && film.genres.length > 0 ? (
                                                <span className="badge bg-white bg-opacity-25 text-white">
                                                    {film.genres[0].name}
                                                </span>
                                            ) : (
                                                <span className="badge bg-white bg-opacity-25 text-white">
                                                    Nessun genere
                                                </span>
                                            )}
                                        </div>
                                        <h5 className="fw-bold mb-2">{film.title}</h5>
                                        <p className="mb-0 small" style={{ opacity: 0.9 }}>
                                            {film.director}
                                        </p>
                                    </div>

                                    {/* Poster del film */}
                                    <div style={{ height: '300px', overflow: 'hidden' }}>
                                        {film.poster_url ? (
                                            <img
                                                src={film.poster_url}
                                                alt={`Poster di ${film.title}`}
                                                style={{
                                                    width: '100%',
                                                    height: '300px',
                                                    objectFit: 'cover',
                                                    transition: 'transform 0.3s ease'
                                                }}
                                                onError={(e) => {
                                                    e.target.style.display = 'none';
                                                    e.target.nextSibling.style.display = 'flex';
                                                }}
                                            />
                                        ) : null}
                                        <div
                                            style={{
                                                height: '300px',
                                                background: 'linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%)',
                                                display: film.poster_url ? 'none' : 'flex',
                                                flexDirection: 'column',
                                                alignItems: 'center',
                                                justifyContent: 'center',
                                                color: '#6c757d',
                                                borderBottom: '1px solid #dee2e6'
                                            }}
                                        >
                                            <i className="fas fa-film" style={{ fontSize: '3rem', marginBottom: '1rem', opacity: 0.5 }}></i>
                                            <span style={{ fontSize: '0.9rem', fontWeight: '500' }}>Nessun poster</span>
                                        </div>
                                    </div>

                                    <div className="card-body d-flex flex-column">
                                        <p className="text-muted mb-4 flex-grow-1">
                                            {film.description.length > 120 ?
                                                film.description.substring(0, 120) + '...' :
                                                film.description
                                            }
                                        </p>

                                        <div className="mb-3">
                                            <div className="d-flex justify-content-between align-items-center">
                                                <span className="text-muted small">{film.duration_minutes} min</span>
                                                <span className="text-muted small">
                                                    {film.genres ? film.genres.length : 0} generi
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div className={`card-footer text-white text-center ${cardColor}`} style={{ border: 'none' }}>
                                        <a href={`/film/${film.id}`} className="text-white text-decoration-none fw-semibold">
                                            Dettagli →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        );
                    })}
                </div>
            </div>
        </div>
    );
}

export default Home;