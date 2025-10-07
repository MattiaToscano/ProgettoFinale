import React from 'react';
import { Link } from 'react-router-dom';

const FilmCard = ({ film }) => {
    return (
        <div className="col-xl-3 col-lg-4 col-md-6 mb-4">
            <div className="card film-card shadow-sm h-100">
                {/* Poster */}
                {film.poster_url ? (
                    <img
                        src={film.poster_url}
                        alt={`Poster di ${film.title}`}
                        className="card-img-top"
                        style={{ height: '300px', objectFit: 'cover' }}
                    />
                ) : (
                    <div
                        className="card-img-top d-flex align-items-center justify-content-center bg-light text-muted"
                        style={{ height: '300px' }}
                    >
                        <div className="text-center">
                            <i className="fas fa-film fa-3x mb-2"></i>
                            <p>Nessun poster</p>
                        </div>
                    </div>
                )}

                {/* Header con anno */}
                <div className="card-header text-center text-white">
                    <h5 className="mb-0 fw-bold">{film.release_year}</h5>
                </div>

                {/* Corpo della card */}
                <div className="card-body d-flex flex-column p-4">
                    {/* Titolo */}
                    <h5 className="film-title">{film.title}</h5>

                    {/* Regista */}
                    <div className="mb-3">
                        <div className="d-flex align-items-center mb-2">
                            <i className="fas fa-user-tie text-primary me-2"></i>
                            <small className="text-muted fw-bold">REGISTA</small>
                        </div>
                        <p className="director-name mb-0">{film.director}</p>
                    </div>

                    {/* Durata e Rating */}
                    <div className="mb-3">
                        <div className="d-flex align-items-center mb-2">
                            <i className="fas fa-clock text-primary me-2"></i>
                            <small className="text-muted fw-bold">DURATA</small>
                        </div>
                        <div className="d-flex gap-2 align-items-center">
                            <span className="badge duration-badge">{film.duration_minutes} minuti</span>
                            {film.rating && (
                                <span className="badge rating-badge">
                                    <i className="fas fa-star me-1"></i>{film.rating}/10
                                </span>
                            )}
                        </div>
                    </div>

                    {/* Generi */}
                    <div className="mb-4 flex-grow-1">
                        <div className="d-flex align-items-center mb-2">
                            <i className="fas fa-tags text-primary me-2"></i>
                            <small className="text-muted fw-bold">GENERI</small>
                        </div>
                        <div className="d-flex flex-wrap">
                            {film.genres && film.genres.length > 0 ? (
                                film.genres.map(genre => (
                                    <span key={genre.id} className="badge genre-badge">{genre.name}</span>
                                ))
                            ) : (
                                <small className="text-muted fst-italic">Nessun genere assegnato</small>
                            )}
                        </div>
                    </div>

                    {/* Bottone visualizza */}
                    <div className="mt-auto">
                        <Link
                            to={`/film/${film.id}`}
                            className="btn btn-custom-view btn-sm w-100"
                        >
                            <i className="fas fa-eye me-2"></i>Visualizza Dettagli
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default FilmCard;