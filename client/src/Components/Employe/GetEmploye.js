import React, { useState, useEffect } from "react";
import axios from 'axios';
import { Link } from "react-router-dom";
import { Checkbox } from "@mui/material";

const GetEmploye = () => {
    const [employes, setEmployes] = useState([]);
    const [idEmployes, setIdEmployes] = useState([]);

    const handleCheckBoxChange = (event, id) => {
        if (event.checked) {
            setIdEmployes((prevId) => [...prevId, id]);
        } else {
            setIdEmployes((prevId) => prevId.filter((idEmploye) => idEmploye !== id));
        }
    }

    const fetchEmploye = async () => {
        try {
            const response = await axios.post('http://127.0.0.1:8000/api/employe', { withCredentials: true });
            setEmployes(response.data);
        } catch (error) {

        }
    }

    const deleteEmploye = async () => {
        try {
            const filtreEmployes = idEmployes.filter((id) => {
                const employe = employes.find((user) => user.id === id);
                return employe.role !== "Admin";
            });
            await axios.post("https://localhost:8000/api/employe", { ids: filtreEmployes }, { withCredentials: true });
            fetchEmploye();
            setIdEmployes([]);
        } catch (error) {
        }
    }
    useEffect(() => {
        fetchEmploye();
    }, []);



    const employesFormat = employes.map((employe) => (
        <div key={employe.id}>
            <div className="d-flex flex-row">
                <Checkbox
                    
                    checked={idEmployes.includes(employe.id)}
                    onChange={(e) => handleCheckBoxChange(e, employe.id)}
                />
                <Link to={`/employe/update/${employe.id}`}>
                    <div >Id: {employe.id}</div>
                    <div >Email: {employe.email}</div>
                </Link>
            </div>
        </div>
    ));

    return (
        <>
            <h3 >Liste Employe</h3>
            {employesFormat}

            {idEmployes.length > 0 && (
                <button  onClick={deleteEmploye}>
                    Supprimer
                </button>
            )}

            <button ><Link to="/signup">
                Ajouter
            </Link></button>

        </>
    )
}

export default GetEmploye