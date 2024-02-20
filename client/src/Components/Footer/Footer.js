import React from 'react';
import "./Footer.css"

const Footer = ({ horaires, loading, error }) => {

    if (loading) {
        return <div>Chargement en cours...</div>;
    }

    if (error) {
        return <div>Une erreur s'est produite: {error}</div>;
    }

    const formatDate = (dateTimeString) => {
        const dateTime = new Date(dateTimeString);
        const hours = dateTime.getHours().toString().padStart(2, '0');
        const minutes = dateTime.getMinutes().toString().padStart(2, '0');
        return `${hours}:${minutes}`;
    };

    return (
        <>
            <ul className="list-unstyled">
                {horaires["hydra:member"].map((horaire, index) => (
                    <li key={index}>
                        <p className='text-info'>
                            Jour: {horaire.jourSemaine === 'Dimanche' ? 'Fermé' : horaire.jourSemaine + " |"}
                            {horaire.jourSemaine === 'Dimanche' ? '' : ` Matin: ${formatDate(horaire.ouvertureMatin)}-${formatDate(horaire.fermetureMatin)} 
                            | Après-midi: ${formatDate(horaire.ouvertureApresMidi)}-${formatDate(horaire.fermetureApresMidi)}`}
                        </p>
                    </li>
                ))}
            </ul>
        </>
    );
};

export default Footer;
