import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Routes, Route } from 'react-router-dom';
import { Container } from 'react-bootstrap';

import LoginForm from './Components/Login/Login';
import RegisterForm from './Components/Register/Register';
import Header from './Components/Header/Header';
import AuthRequire from './Components/Auth/AuthRequire';
import Layout from './Components/Layout/Layout';
import Horaire from './Components/Footer/Horaire';
import AdminSpace from './Components/AdminSpace/AdminSpace';
import UnauthorizedPage from './Components/Layout/UnauthorizedPage';
import HoraireUpdate from './Components/Horaires/HorairesUpdate';
import Home from './Components/Layout/Home';
import ContactPage from './Components/Contact/Contact';
import GetEmploye from './Components/Employe/GetEmploye';
import UpdateEmploye from './Components/Employe/UpdateEmploye';
import GetAvis from './Components/Avis/Avis';

function App() {
  return (

    <div className=" bg-dark text-light min-vh-100 d-flex flex-column App">
      <Container fluid className="header">
        <Header />
      </Container>

      <Container className='content d-flex justify-content-center align-items-center min-vh-80 text-center'>
        <Routes>

          <Route path='/' element={<Layout />}>
            <Route path='/home' element={<Home />} />
            <Route path='/contact' element={<ContactPage />} />
            <Route path="/unauthorized" element={<UnauthorizedPage />} />
            <Route path="/login" element={<LoginForm />} />
            <Route path="/register" element={<RegisterForm />} />
          </Route  >
          <Route element={<AuthRequire role={["Admin", "Employe"]} />}>
            <Route path='/avis' element={<GetAvis />} />
          </Route>
          <Route element={<AuthRequire role={["Admin"]} />}>
            <Route path='/admin' element={<AdminSpace />} />
            <Route path='/horaires' element={<HoraireUpdate />} />
            <Route path='/employes' element={<GetEmploye />} />
            <Route path='/employe/update/:idEmploye' element={<UpdateEmploye />} />

          </Route>

        </Routes>


      </Container>
      <Container fluid className="footer">
        <Horaire />
      </Container>
    </div>
  );
}

export default App;
