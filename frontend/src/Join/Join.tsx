import React from 'react';
import { Link } from 'react-router';
import System from '../Layout/System';
import JoinForm from './JoinForm';

const Join: React.FC = () => {
  return (
    <System>
      <h1>Join to Us</h1>
      <JoinForm />
      <p>
        <Link to="/">Back to Home</Link>
      </p>
    </System>
  );
};

export default Join;
