import { useContext } from 'react';
import  AuthContext  from './AuthProvider';

const AuthUse = () => {
    const authContext = useContext(AuthContext);
    return authContext;
};

export default AuthUse;