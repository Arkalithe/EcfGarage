import React from 'react';

const Footer = ({ time, loading, error }) => {
    console.log("Props in Footer:", { time, loading, error });
    if (loading) {
        return <div>Chargement en cours...</div>;
    }
    console.log("Horaires dans Footer :", time);
    if (error) {
        return <div>Une erreur s'est produite: {error}</div>;
    }
    console.log("Horaires dans Footer :", time);

    return (
        <div>
            <ul className="list-unstyled">
                {time.map((horaire, index) => (
                    <li key={index}>
                        <p className='text-info fs-4 mb-0'>
                            Jour: {horaire.jour === 'Dimanche' ? 'Fermé' : horaire.jour+" |" }  
                            {horaire.jour === 'Dimanche' ? '' : ` Matin: ${horaire.matinOuverture}:${horaire.matinFermeture} | Après-midi: ${horaire.apresMidiOuverture}:${horaire.apresMidiFermeture}`}
                        </p>
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default Footer;
