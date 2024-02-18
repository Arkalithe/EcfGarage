import React, { useEffect, useState } from 'react';
import axios from 'axios'
import Footer from './Footer'
import { Container } from 'react-bootstrap';
import "./Footer.css"

const Horaire = () => {

    const [horaires, setHoraires] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchHoraires = async () => {
            try {
                const response = await axios.get('http://127.0.0.1:8000/api/horaires/');
                setHoraires(response.data);
                setLoading(false);
            } catch (error) {
                setError(error);
                setLoading(false);
            }
        };

        fetchHoraires();
    }, []);

    

 

    console.log("Horaires dans Horaire :", horaires);

    return (        
        <Container className="horaire">
        <Footer horaires={horaires} loading={loading} error={error} />
        </Container>
    )
};

export default Horaire;