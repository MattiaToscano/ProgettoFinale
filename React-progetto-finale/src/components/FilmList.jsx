import React from 'react';
import FilmCard from './FilmCard';

const FilmList = ({ films }) => {
    return (
        <>
            {/* Header della pagina */}
            <div className="page-header">
                <div className="container">
                    <div className="row">
                        <div className="col-lg-8">
                            <h1 className="display-4 fw-bold mb-3"> La Mia Collezione Film</h1>
                            <p className="lead mb-0">Esplora la nostra collezione di film</p>
                        </div>
                        <div className="col-lg-4 d-flex align-items-center justify-content-lg-end justify-content-start mt-3 mt-lg-0">
                            <div className="text-white">
                                <i className="fas fa-film me-2"></i>
                                <span className="fw-bold">{films.length} Film Disponibili</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Contenuto principale con sfondo bianco */}
            <div className="main-content">
                <div className="container mb-5">
                    <div className="row g-4">
                        {films && films.length > 0 ? (
                            films.map(film => (
                                <FilmCard key={film.id} film={film} />
                            ))
                        ) : (
                            /* Stato vuoto */
                            <div className="col-12">
                                <div className="empty-state">
                                    <div className="icon">
                                        <i className="fas fa-film"></i>
                                    </div>
                                </div>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </>
    );
};

export default FilmList;