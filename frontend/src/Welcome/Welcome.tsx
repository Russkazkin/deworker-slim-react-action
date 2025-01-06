import React from 'react';
import styles from './Welcome.module.sass';

type Props = {
  features: string[];
};
const Welcome: React.FC<Props> = ({ features }) => {
  return (
    <div data-test="welcome" className={styles.welcome}>
      <h1>Auction</h1>
      {features.includes('WE_ARE_HERE') ? (
        <p>We are here</p>
      ) : (
        <p>We will be here soon</p>
      )}
    </div>
  );
};

export default Welcome;
