import React from 'react';
import styles from './Welcome.module.sass';

const Welcome: React.FC = () => {
  return (
    <div data-test="welcome" className={styles.welcome}>
      <h1>Auction</h1>
      <p>We will be here ASAP</p>
    </div>
  );
};

export default Welcome;
