import React, { useEffect, useState } from 'react';
import { Link, Navigate, useLocation } from 'react-router';
import api, { parseError } from '../../Api';
import System from '../../Layout/System';
import { AlertError } from '../../Alert';

function useQuery() {
  return new URLSearchParams(useLocation().search);
}
const Confirm: React.FC = () => {
  const [success, setSuccess] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);
  const query = useQuery();
  const token = query.get('token');
  useEffect(() => {
    if (token && !success && error === null) {
      api
        .post('/v1/auth/join/confirm', { token })
        .then(() => setSuccess(true))
        .catch(async (error) => setError(await parseError(error)));
    }
  }, [success, error, token]);

  if (success) {
    return <Navigate to="/join/success" replace />;
  }

  if (!token) {
    return <Navigate replace to="/" />;
  }
  return (
    <System>
      <div data-testid="join-confirm">
        <h1>Join</h1>
        <AlertError message={error} />
        <p>
          <Link to="/">Back to Home</Link>
        </p>
      </div>
    </System>
  );
};

export default Confirm;
