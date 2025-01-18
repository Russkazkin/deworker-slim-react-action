import React from 'react';
import { Link } from 'react-router';
import System from '../Layout/System';

const NotFound: React.FC = () => {
  return (
    <System>
      <h1>Error</h1>
      <p>Page is not found</p>
      <p>
        <Link to="/">Back to Home</Link>
      </p>
    </System>
  );
};

export default NotFound;
