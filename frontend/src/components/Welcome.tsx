import React from 'react';
import styles from './Welcome.module.sass';

const Welcome: React.FC = () => {
  return (
    <div data-test="welcome" className={styles.welcome}>
      <h1>Auc tion</h1>
      <p>We will be here soon</p>
    </div>
  );
};

export default Welcome;
