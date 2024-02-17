import React, { useEffect, useState } from 'react';
import axios from 'axios'
import Footer from './Footer'
import { Container } from 'react-bootstrap';

const Horaire = () => {

    const time = [
        { jour: 'Lundi', matinOuverture: '08:00', matinFermeture: '12:00', apresMidiOuverture: '13:00', apresMidiFermeture: '18:00' },
        { jour: 'Mardi', matinOuverture: '08:30', matinFermeture: '12:30', apresMidiOuverture: '13:30', apresMidiFermeture: '17:30' },
        { jour: 'Mercredi', matinOuverture: '09:00', matinFermeture: '12:00', apresMidiOuverture: '14:00', apresMidiFermeture: '18:00' },
        { jour: 'Jeudi', matinOuverture: '08:00', matinFermeture: '12:00', apresMidiOuverture: '13:00', apresMidiFermeture: '17:00' },
        { jour: 'Vendredi', matinOuverture: '08:30', matinFermeture: '11:30', apresMidiOuverture: '13:30', apresMidiFermeture: '18:30' },
        { jour: 'Samedi', matinOuverture: '09:00', matinFermeture: '12:00', apresMidiOuverture: '14:00', apresMidiFermeture: '17:00' },
        { jour: 'Dimanche', matinOuverture: 'Fermé', matinFermeture: 'Fermé', apresMidiOuverture: 'Fermé', apresMidiFermeture: 'Fermé' }
    ];   

    console.log("Horaires dans Horaire :", time);

    return (        
        <Container>
        <Footer time={time} loading={false} error={null} />
        </Container>
    )
};

export default Horaire;