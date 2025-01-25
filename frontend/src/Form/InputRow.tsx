import React from 'react';

type Props = {
  error: string | null;
  children: React.ReactNode;
};

const InputRow: React.FC<Props> = ({ error, children }) => {
  return (
    <div className={'input-row' + (error ? ' has-error' : '')}>{children}</div>
  );
};

export default InputRow;
